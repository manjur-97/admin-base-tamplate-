<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MyController extends Command
{
    protected $signature = 'create:mvc {controller} {model} {table}';
    protected $description = 'Create model, service, request and controller files';

    public function handle()
    {

        $controller = $this->argument('controller');
        $model = $this->argument('model');
        $table = $this->argument('table');
        $service = $model . 'Service';

        // Controller
        $controllerPath = app_path('Http/Controllers/Backend/' . $controller . '.php');
        $controllerCode =  $this->generateControllerCode($model, $controller, $table);
        $this->createFile($controllerPath,  $controllerCode);

        // Request
        $requestPath = app_path('Http/Requests/' . $model . 'Request.php');
        $requestCode =  $this->generateRequest($model, $table);
        $this->createFile($requestPath,   $requestCode);

        // Service
        $servicePath = app_path('Services/' . $model . 'Service.php');
        $serviceCode =  $this->generateServiceCode($model);
        $this->createFile($servicePath,  $serviceCode);

        // Model
        $modelPath = app_path('Models/' . $model . '.php');
        $modelCode = $this->generateModelCode($model, $table);
        $this->createFile($modelPath,  $modelCode);

        // route
        $routePath = base_path('routes/dynamic_route.php');
        $routeCode = $this->generateRouteCode($controller, $model);
        $this->createRoute($routePath, $routeCode);
        // View
        $backendPath = resource_path('js/Pages/Backend/');
        $indexFile = $backendPath . $model . '/Index.vue';
        $formFile = $backendPath . $model . '/Form.vue';

        // Check if directory exists, if not create it
        if (!File::isDirectory($backendPath . $model)) {
            File::makeDirectory($backendPath . $model, 0755, true, true);
        }

        if (File::exists($indexFile)) {
            $this->error('Index file already exists at:' . $indexFile);
            return;
        }
        if (File::exists($formFile)) {
            $this->error('Form file already exists at:' . $formFile);
            return;
        }

        File::put($indexFile, $this->IndexVue($model));
        File::put($formFile, $this->Form($model, $table));

        $this->info('Index created successfully:' . $indexFile);
        $this->info('Form created successfully:' . $formFile);
    }

    public function createRoute($routePath, $routeCode)
    {
        if (File::exists($routePath)) {
            // Append code to an existing file
            $existingCode = File::get($routePath);
            $updatedCode = $existingCode . PHP_EOL . $routeCode; // Append new code with a new line
            File::put($routePath, $updatedCode);
            $this->info('Code appended to existing file: ' . $routePath);
        } else {
            // Create a new file with the provided code
            File::put($routePath, $routeCode);
            $this->info('File created successfully: ' . $routePath);
        }
    }
    public function generateRouteCode($controller,  $model)
    {
        $lowercaseModel = strtolower($model);
        $code = <<<EOT

        // $model
        Route::resource('$lowercaseModel', 'App\Http\Controllers\Backend\\$controller')->except(['show']);
        Route::get('$lowercaseModel/{id}/status/{status}/change', 'App\Http\Controllers\Backend\\$controller@changeStatus')->name('$lowercaseModel.status.change');

        EOT;

        return $code;
    }

    // Function to create file
    private function createFile($filePath, $code)
    {
        if (File::exists($filePath)) {
            File::delete($filePath);
            $this->info('Existing file deleted: ' . $filePath);
        }

        // Create the new file with the provided code
        File::put($filePath, $code);
        $this->info('File created successfully: ' . $filePath);
    }


    function generateModelCode($model, $table)
    {
        $relationshipDetails = DB::select("
            SELECT
                TABLE_NAME AS referencing_table,
                COLUMN_NAME AS foreign_key_column,
                REFERENCED_TABLE_NAME AS parent_table,
                REFERENCED_COLUMN_NAME AS parent_column
            FROM
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE
                TABLE_NAME = ?
                AND TABLE_SCHEMA = DATABASE()
                AND REFERENCED_TABLE_NAME IS NOT NULL
        ", [$table]);
        $code = <<<EOT
        <?php
        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;
        use Illuminate\Database\Eloquent\SoftDeletes;
       


        class $model extends Model
        {
            use HasFactory, SoftDeletes;


            protected \$table = '$table';

            protected \$fillable = [
        EOT;
        $columnNames = Schema::getColumnListing($table);
        foreach ($columnNames as $columnName) {
            if (!in_array($columnName, ['id', 'created_at', 'updated_at', 'deleted_at', 'status'])) {
                $code .= <<<EOT
                                '$columnName',
                            EOT;
            }
        }

        $code .= <<<EOT
            ];

            protected static function boot()
            {
                parent::boot();
                static::saving(function (\$model) {
                    \$model->created_at = date('Y-m-d H:i:s');
                });

                static::updating(function (\$model) {
                    \$model->updated_at = date('Y-m-d H:i:s');
                });
            }
            EOT;
        // Add dynamic relationships
        foreach ($relationshipDetails as $relation) {
            $foreignKey = $relation->foreign_key_column;
            $parentTable = Str::singular($relation->parent_table);
            $parentModel = ucfirst($parentTable);

            // Assuming "belongsTo" relationship
            $code .= <<<EOT

        public function {$parentTable}()
        {
            return \$this->belongsTo(\App\Models\\$parentModel::class, '$foreignKey');
        }
        EOT;
        }

        // Add dynamic accessor for image attributes
        if (in_array('photo', $columnNames) || in_array('image', $columnNames) || in_array('images', $columnNames) || in_array('photos', $columnNames)) {
            $code .= <<<EOT

        public function getImageAttribute(\$value)
        {
            return (!is_null(\$value)) ? env('APP_URL') . '/public/storage/' . \$value : null;
        }
        EOT;
        }

        // Add dynamic accessor for file attributes
        if (in_array('file', $columnNames) || in_array('files', $columnNames) || in_array('pdf', $columnNames)) {
            $code .= <<<EOT

        public function getFileAttribute(\$value)
        {
            return (!is_null(\$value)) ? env('APP_URL') . '/public/storage/' . \$value : null;
        }
        EOT;
        }
        $code .= <<<EOT
             
        }

        EOT;

        return $code;
    }

    function generateServiceCode($model)
    {

        $code = <<<EOT
        <?php
        namespace App\Services;
        use App\Models\\$model;

        class {$model}Service
        {
            protected \$${model}Model;

            public function __construct($model \$${model}Model)
            {
                \$this->${model}Model = \$${model}Model;
            }

            public function list()
            {
                return  \$this->${model}Model->whereNull('deleted_at');
            }

            public function all()
            {
                return  \$this->${model}Model->whereNull('deleted_at')->all();
            }

            public function find(\$id)
            {
                return  \$this->${model}Model->find(\$id);
            }

            public function create(array \$data)
            {
                return  \$this->${model}Model->create(\$data);
            }

            public function update(array \$data, \$id)
            {
                \$dataInfo =  \$this->${model}Model->findOrFail(\$id);

                \$dataInfo->update(\$data);

                return \$dataInfo;
            }

            public function delete(\$id)
            {
                \$dataInfo =  \$this->${model}Model->find(\$id);

                if (!empty(\$dataInfo)) {

                    \$dataInfo->deleted_at = date('Y-m-d H:i:s');

                    \$dataInfo->status = 'Deleted';

                    return (\$dataInfo->save());
                }
                return false;
            }

            public function changeStatus(\$id,\$status)
            {
                \$dataInfo =  \$this->${model}Model->findOrFail(\$id);
                \$dataInfo->status = \$status;
                \$dataInfo->update();

                return \$dataInfo;
            }

            public function AdminExists(\$userName)
            {
                return  \$this->${model}Model->whereNull('deleted_at')
                    ->where(function (\$q) use (\$userName) {
                        \$q->where('email', strtolower(\$userName))
                            ->orWhere('phone', \$userName);
                    })->first();

            }


            public function activeList()
            {
                return  \$this->${model}Model->whereNull('deleted_at')->where('status', 'Active')->get();
            }

        }


        EOT;

        return $code;
    }

    function generateRequest($model, $table)
    {
        $columns = DB::select("
        SELECT
            COLUMN_NAME as name,
            DATA_TYPE as type,
            IS_NULLABLE as is_nullable,
            CHARACTER_MAXIMUM_LENGTH as max_length,
            NUMERIC_PRECISION as numeric_precision
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
    ", [env('DB_DATABASE'), $table]);

        $code = <<<EOT
    <?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class {$model}Request extends FormRequest
    {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, mixed>
         */
        public function rules()
        {
            switch (\$this->method()) {
                case 'POST':
                    return [
    EOT;

        foreach ($columns as $column) {
            $columnName = $column->name;
            $isNullable = $column->is_nullable === 'YES';
            $maxLength = $column->max_length;
            $precision = $column->numeric_precision;
            $dataType = $column->type;

            if (!in_array($columnName, ['id', 'created_at', 'image', 'updated_at', 'deleted_at', 'status'])) {
                $rule = $isNullable ? 'nullable' : 'required';

                // Determine the rule based on data type
                if (in_array($dataType, ['varchar', 'text', 'char'])) {
                    $rule .= '|string';
                    if ($maxLength) {
                        $rule .= '|max:' . $maxLength;
                    }
                } elseif (in_array($dataType, ['int', 'bigint', 'smallint', 'tinyint'])) {
                    $rule .= '|integer';
                } elseif (in_array($dataType, ['decimal', 'float', 'double'])) {
                    $rule .= '|numeric';
                    if ($precision) {
                        $rule .= '|digits_between:1,' . $precision;
                    }
                } elseif (in_array($dataType, ['date', 'datetime', 'timestamp'])) {
                    $rule .= '|date';
                }

                $code .= "\n                '$columnName' => '$rule',";
            }
        }

        // End the 'POST' case and start the 'PATCH'/'PUT' case
        $code .= <<<EOT

                    ];
                    break;

                case 'PATCH':
                case 'PUT':
                    return [
    EOT;

        foreach ($columns as $column) {
            $columnName = $column->name;
            $isNullable = $column->is_nullable === 'YES';
            $maxLength = $column->max_length;
            $precision = $column->numeric_precision;
            $dataType = $column->type;
            if (!in_array($columnName, ['id', 'created_at', 'image ', 'updated_at', 'deleted_at', 'status'])) {
                $rule = $isNullable ? 'nullable' : 'required';

                // Reuse validation rules logic for PATCH/PUT, omitting 'required'
                if (in_array($dataType, ['varchar', 'text', 'char'])) {
                    $rule .= '|string';
                    if ($maxLength) {
                        $rule .= '|max:' . $maxLength;
                    }
                } elseif (in_array($dataType, ['int', 'bigint', 'smallint', 'tinyint'])) {
                    $rule .= '|integer';
                } elseif (in_array($dataType, ['decimal', 'float', 'double'])) {
                    $rule .= '|numeric';
                    if ($precision) {
                        $rule .= '|digits_between:1,' . $precision;
                    }
                } elseif (in_array($dataType, ['date', 'datetime', 'timestamp'])) {
                    $rule .= '|date';
                }

                $code .= "\n                '$columnName' => '$rule',";
            }
        }

        // Close the rules function
        $code .= <<<EOT

                    ];
                    break;
            }
        }

        public function messages()
        {
            return [
    EOT;

        // Add custom messages for each field and validation rule
        foreach ($columns as $column) {
            $columnName = $column->name;
            $UCfirst = ucfirst(str_replace('_', ' ', $columnName));

            if (!in_array($columnName, ['id', 'created_at', 'image', 'updated_at', 'deleted_at', 'status'])) {
                if ($column->is_nullable !== 'YES') {
                    $code .= "\n                '$columnName.required' => 'Please provide the $UCfirst.',";
                }
                if ($column->is_nullable === 'YES') {
                    $code .= "\n                '$columnName.nullable' => 'The $UCfirst is optional.',";
                }
                if ($column->type == 'string') {
                    $code .= "\n                '$columnName.string' => 'The $UCfirst must be a valid text value.',";
                }

                if ($column->type == 'integer') {
                    $code .= "\n                '$columnName.integer' => 'The $UCfirst must be a valid integer.',";
                }

                if ($column->max_length) {
                    $code .= "\n                '$columnName.max' => 'The $UCfirst cannot exceed :max characters.',";
                }
                if ($column->numeric_precision) {
                    $code .= "\n                '$columnName.numeric' => 'The $UCfirst must be a numeric value.',";
                }
                if ($column->type == 'date') {
                    $code .= "\n                '$columnName.date' => 'The $UCfirst must be a valid date.',";
                }
                if ($column->numeric_precision) {
                    $code .= "\n                '$columnName.digits_between' => 'The $UCfirst must be between 1 and :digits digits.',";
                }
            }
        }

        // Close the messages function and the class
        $code .= <<<EOT

            ];
        }
    }
    EOT;

        return $code;
    }



    function generateControllerCode($model, $controller, $table)
    {
        $relationshipDetails = DB::select("
            SELECT
                TABLE_NAME AS referencing_table,
                COLUMN_NAME AS foreign_key_column,
                REFERENCED_TABLE_NAME AS parent_table,
                REFERENCED_COLUMN_NAME AS parent_column
            FROM
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE
                TABLE_NAME = ?
                AND TABLE_SCHEMA = DATABASE()
                AND REFERENCED_TABLE_NAME IS NOT NULL
        ", [$table]);

        $lowercaseModel = strtolower($model);
        $service = $model . 'Service';

        $code = <<<EOT
    <?php
        namespace App\Http\Controllers\Backend;

        use App\Http\Controllers\Controller;
        use App\Http\Requests\\{$model}Request;
        use Illuminate\Support\Facades\DB;
        use App\Services\\{$model}Service;
    EOT;

        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {

                $parentModel = ucfirst(Str::singular($relation->parent_table));
                $relationalService = $parentModel . 'Service';
                $code .= <<<EOT
                   use App\Services\\{$relationalService};
                EOT;
            }
        }


        $code .= <<<EOT
        use Illuminate\Http\Request;
        use Inertia\Inertia;
        use App\Traits\SystemTrait;
        use Exception;

        class $controller extends Controller
        {
            use SystemTrait;

            protected \$$service;

    EOT;

        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {

                $parentModel = ucfirst(Str::singular($relation->parent_table));
                $relationalService = $parentModel . 'Service';
                $code .= <<<EOT
                    protected \$$relationalService;
                EOT;
            }
        }


        $code .= <<<EOT

            public function __construct($service \$$service 
        EOT;
        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {

                $parentModel = ucfirst(Str::singular($relation->parent_table));
                $relationalService = $parentModel . 'Service';
                $code .= <<<EOT
                    , $relationalService \$$relationalService
                EOT;
            }
        }

        $code .= <<<EOT
            )
            {
                \$this->$service = \$$service;
        EOT;

        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {

                $parentModel = ucfirst(Str::singular($relation->parent_table));
                $relationalService = $parentModel . 'Service';
                $code .= <<<EOT
                   \$this->$relationalService = \$$relationalService;
                EOT;
            }
        }

        $code .= <<<EOT
            }

            public function index()
            {
                return Inertia::render(
                    'Backend/$model/Index',
                    [
                        'pageTitle' => fn () => '$model List',
                        'breadcrumbs' => fn () => [
                            ['link' => null, 'title' => '$model Manage'],
                            ['link' => route('backend.$lowercaseModel.index'), 'title' => '$model List'],
                        ],
                        'tableHeaders' => fn () => \$this->getTableHeaders(),
                        'dataFields' => fn () => \$this->dataFields(),
                        'datas' => fn () => \$this->getDatas(),
                         'countedData' => fn() => \$this->countedData(),
                    ]
                );
            }
                 private function countedData()
                        {
                            \$query = \$this->{$service}->list();

                            \$countedValue = \$query->count();

                            
                            return \$countedValue;
                        }

            private function getDatas()
            {
                \$query = \$this->{$service}->list();

                  if (request()->filled('name')) {
                        \$query->where(function (\$q) {
                            \$q->where('name', 'like', '%' . request()->name . '%');
                        });
                    }

                \$datas = \$query->paginate(request()->numOfData ?? 10)->withQueryString();

                \$formattedDatas = \$datas->map(function (\$data, \$index)  {
                    \$customData = new \stdClass();
                    \$customData->index = \$index + 1;
    EOT;

        $columnNames = Schema::getColumnListing($table);

        // Iterate through each column name and set the corresponding property in \$customData
        foreach ($columnNames as $columnName) {
            // Check if the column exists in the \$data object before accessing it
            if (!in_array($columnName, ['created_at', 'updated_at', 'deleted_at', 'image', 'photo', 'file'])) {
                $code .= "\$customData->$columnName = \$data->$columnName;";

                continue;
            }

            if (in_array($columnName, ['image', 'photo', 'file'])) {
                $code .= "\$customData->$columnName ='<img src=\"' . \$data->$columnName . '\" height=\"50\" width=\"50\"/>' ?? '';\n";
                continue;
            }
        }
        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relationship) {
                $relatedTable = Str::singular($relationship->parent_table);
                $relatedColumn = 'name';

                // Dynamically add the related column to $customData
                $code .= <<<EOT
                    \$customData->{$relatedTable}_{$relatedColumn} = \$data->{$relatedTable}?->{$relatedColumn} ?? "";
                EOT;
                continue;
            }
        };

        $code .= <<<EOT
                    // Set other properties as before
                    \$customData->status = getStatusText(\$data->status);
                    \$customData->hasLink = true;
                    \$customData->links = [
                    [
                    'linkClass' => 'statusChange btn btn-info shadow btn-xs sharp me-1 ' . ((\$data->status == 'Active') ?  "bg-info" : "bg-secondary"),
                    'link' => route('backend.$lowercaseModel.status.change', ['id' => \$data->id, 'status' => \$data->status == 'Active' ? 'Inactive' : 'Active']),
                    'linkLabel' => getLinkLabel(
                        (\$data->status == 'Active' ? "<i class='fas fa-toggle-on'></i>" : "<i class='fas fa-toggle-off'></i>"),
                        null,
                        null
                    )
                ],
                [
                    'linkClass' => 'btn btn-primary shadow btn-xs sharp me-1',
                    'link' => route('backend.$lowercaseModel.edit', \$data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-pencil"></i>', null)
                ],

                [
                    'linkClass' => 'deleteButton btn btn-danger shadow btn-xs sharp',
                    'link' => route('backend.$lowercaseModel.destroy', \$data->id),
                    'linkLabel' => getLinkLabel(null, '<i class="fa fa-trash"></i>', null)
                ]
                        
                    ];
                    return \$customData;
                });

                return regeneratePagination(\$formattedDatas, \$datas->total(), \$datas->perPage(), \$datas->currentPage());
            }

            private function dataFields()
            {
                return [
    EOT;

        // Filter out unwanted columns and set the field name with the class
        foreach ($columnNames as $columnName) {
            if (!in_array($columnName, ['created_at', 'updated_at', 'deleted_at'])) {
                $columnName = ($columnName === 'id') ? 'index' : $columnName;
                $tableHeader = ucfirst(str_replace('_', ' ', $columnName));
                $class = ($columnName === 'id') ? 'text-center text-wrap' : 'text-center text-wrap';

                $isRelationColumn = false;

                if ($relationshipDetails) {
                    foreach ($relationshipDetails as $relation) {
                        $relatedTable = Str::singular($relationship->parent_table);
                        $relatedColumn = 'name';
                        if ($columnName == $relation->foreign_key_column) {
                            $isRelationColumn = true;
                            $columnName = $relatedTable . "_" . $relatedColumn;
                            $code .= "                ['fieldName' => '$columnName', 'class' => '$class'],\n";
                        }
                    }
                }

                if ($isRelationColumn) {
                    continue;
                }

                $code .= "                ['fieldName' => '$columnName', 'class' => '$class'],\n";
            }
        }

        $code .= <<<EOT
                ];
            }

            private function getTableHeaders()
            {
                return [
                    'Sl/No',
    EOT;

        foreach ($columnNames as $columnName) {
            if (!in_array($columnName, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                $tableHeader = ucfirst(str_replace('_', ' ', $columnName));

                $isRelationColumn = false;

                if ($relationshipDetails) {
                    foreach ($relationshipDetails as $relation) {
                        $relatedTable = Str::singular($relationship->parent_table);
                        $relatedColumn = 'name';
                        if ($columnName == $relation->foreign_key_column) {
                            $isRelationColumn = true;
                            $tableHeader = $relatedTable;
                            $code .= "'$tableHeader',\n";
                        }
                    }
                }

                if ($isRelationColumn) {
                    continue;
                }

                $code .= "                '$tableHeader',\n";
            }
        }

        $code .= <<<EOT
                    'Action'
                ];
            }

            public function create()
            {
                return Inertia::render(
                    'Backend/$model/Form',
                    [
                        'pageTitle' => fn () => '$model Create',
                        'breadcrumbs' => fn () => [
                            ['link' => null, 'title' => '$model Manage'],
                            ['link' => route('backend.$lowercaseModel.create'), 'title' => '$model Create'],
                        ],
                        'countedData' => fn() => \$this->countedData(),
                         
        EOT;
        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {
                $relationalTable = $relation->parent_table;
                $parentModel = ucfirst(Str::singular($relation->parent_table));
                $relationalService = $parentModel . 'Service';
                $code .= <<<EOT
                                   '$relationalTable' => fn() => \$this->{$relationalService}->activeList(),
                                EOT;
            }
        }

        $code .= <<<EOT
                    ]
                );
            }

            public function store({$model}Request \$request)
            {
                DB::beginTransaction();
                try {
                    \$data = \$request->validated();

        EOT;

        foreach ($columnNames as $columnName) {
            if (in_array($columnName, ['image', 'images', 'photo', 'photos'])) {
                $code .= <<<EOT
                                if (\$request->hasFile('$columnName')) {
                                    \$data['$columnName'] = \$this->imageUpload(\$request->file('$columnName'), '$table');
                                }
                            EOT;
            }
        }
        foreach ($columnNames as $columnName) {
            if (in_array($columnName, ['file', 'files', 'pdf'])) {
                $code .= <<<EOT
                                    if (\$request->hasFile('$columnName')) {
                                    \$data['$columnName'] = \$this->fileUpload(\$request->file('$columnName'), '$table');
                                }
                            EOT;
            }
        }

        $code .= <<<EOT

                    \$dataInfo = \$this->{$service}->create(\$data);

                    if (\$dataInfo) {
                        \$message = '$model created successfully';
                        \$this->storeAdminWorkLog(\$dataInfo->id, '$table', \$message);

                        DB::commit();

                        return redirect()->route("backend.$lowercaseModel.index")->with('successMessage', \$message);
                    } else {
                        DB::rollBack();
                        \$message = "Failed to create $model.";
                        return redirect()->back()->with('errorMessage', \$message);
                    }
                } catch (Exception \$err) {
                    DB::rollBack();
                    \$this->storeSystemError('Backend', '$controller', 'store', substr(\$err->getMessage(), 0, 1000));
                    \$message = "Server Errors Occurred. Please Try Again.";
                    return redirect()->back()->with('errorMessage', \$message);
                }
            }

            public function edit(\$id)
            {
                \$$lowercaseModel = \$this->{$service}->find(\$id);

                return Inertia::render(
                    'Backend/$model/Form',
                    [
                        'pageTitle' => fn () => '$model Edit',
                        'breadcrumbs' => fn () => [
                            ['link' => null, 'title' => '$model Manage'],
                            ['link' => route('backend.$lowercaseModel.edit', \$id), 'title' => '$model Edit'],
                        ],
                        '$lowercaseModel' => fn () => \$$lowercaseModel,
                        'id' => fn () => \$id,
                        'countedData' => fn() => \$this->countedData(),
            EOT;
        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {
                $relationalTable = $relation->parent_table;
                $parentModel = ucfirst(Str::singular($relation->parent_table));
                $relationalService = $parentModel . 'Service';
                $code .= <<<EOT
                                   '$relationalTable' => fn() => \$this->{$relationalService}->activeList(),
                                EOT;
            }
        }

        $code .= <<<EOT
                    ]
                );
            }

            public function update({$model}Request \$request, \$id)
            {
                DB::beginTransaction();
                try {
                    \$data = \$request->validated();
                    \$$lowercaseModel = \$this->{$service}->find(\$id);

                    
        EOT;

        foreach ($columnNames as $columnName) {
            if (in_array($columnName, ['image', 'images', 'photo', 'photos'])) {
                $code .= <<<EOT
                              if (\$request->hasFile('$columnName')) {
                                    \$data['$columnName'] = \$this->imageUpload(\$request->file('$columnName'), '$table');
                                    \$path = strstr(\${$lowercaseModel}->$columnName, 'storage/');
                                    if (file_exists(\$path)) {
                                        unlink(\$path);
                                    }
                                } else {
                                    \$data['$columnName'] = \${$lowercaseModel}->$columnName; // keep existing image
                                }
                            EOT;
            }
        }
        foreach ($columnNames as $columnName) {
            if (in_array($columnName, ['file', 'files', 'pdf'])) {
                $code .= <<<EOT
                                     if (\$request->hasFile('$columnName')) {
                                        \$data['$columnName'] = \$this->fileUpload(\$request->file('$columnName'), '$table/');
                                        \$path = strstr(\${$lowercaseModel}->$columnName, 'storage/');
                                        if (file_exists(\$path)) {
                                            unlink(\$path);
                                        }
                                    } else {
                                        \$data['$columnName'] = \${$lowercaseModel}->$columnName; // keep existing file
                                    }
                            EOT;
            }
        }

        $code .= <<<EOT
                    

                  

                    \$dataInfo = \$this->{$service}->update(\$data, \$id);

                    if (\$dataInfo) {
                        \$message = '$model updated successfully';
                        \$this->storeAdminWorkLog(\$dataInfo->id, '$table', \$message);

                        DB::commit();

                        return redirect()->route("backend.$lowercaseModel.index")->with('successMessage', \$message);
                    } else {
                        DB::rollBack();
                        \$message = "Failed to update $model.";
                        return redirect()->back()->with('errorMessage', \$message);
                    }
                } catch (Exception \$err) {
                    DB::rollBack();
                    \$this->storeSystemError('Backend', '$controller', 'update', substr(\$err->getMessage(), 0, 1000));
                    \$message = "Server Errors Occurred. Please Try Again.";
                    return redirect()->back()->with('errorMessage', \$message);
                }
            }

            public function changeStatus(\$id, \$status)
            {
                try {

                    \$dataInfo = \$this->{$service}->changeStatus(\$id, \$status);

                    if (\$dataInfo->wasChanged()) {
                        \$message = '$model ' . request()->status . ' Successfully';
                        \$this->storeAdminWorkLog(\$dataInfo->id, '$table', \$message);

                        DB::commit();

                        return redirect()
                            ->back()
                            ->with('successMessage', \$message);
                    } else {
                        DB::rollBack();

                        \$message = "Failed To " . request()->status . "$model.";
                        return redirect()
                            ->back()
                            ->with('errorMessage', \$message);
                    }
                } catch (Exception \$err) {
                    DB::rollBack();
                    \$this->storeSystemError('Backend', '$controller', 'changeStatus', substr(\$err->getMessage(), 0, 1000));
                    DB::commit();
                    \$message = "Server Errors Occur. Please Try Again.";
                    return redirect()
                        ->back()
                        ->with('errorMessage', \$message);
                }
            }

             public function destroy(\$id)
            {

                DB::beginTransaction();

                try {

                    if (\$this->{$service}->delete(\$id)) {
                        \$message = '$model deleted successfully';
                        \$this->storeAdminWorkLog(\$id, '{$table}', \$message);

                        DB::commit();

                        return redirect()
                            ->back()
                            ->with('successMessage', \$message);
                    } else {
                        DB::rollBack();

                        \$message = "Failed To Delete $model.";
                        return redirect()
                            ->back()
                            ->with('errorMessage', \$message);
                    }
                } catch (Exception \$err) {
                    DB::rollBack();
                    \$this->storeSystemError('Backend', '$controller', 'destroy', substr(\$err->getMessage(), 0, 1000));
                    DB::commit();
                    \$message = "Server Errors Occur. Please Try Again.";
                    return redirect()
                        ->back()
                        ->with('errorMessage', \$message);
                }
            }
        }
        EOT;

        return $code;
    }


    function IndexVue($model)
    {
        $lowercaseModel = strtolower($model);
        $code = <<<EOT

        <script setup>
            import { ref } from "vue";
            import BackendLayout from '@/Layouts/BackendLayout.vue';
            import BaseTable from '@/Components/BaseTable.vue';
            import Pagination from '@/Components/Pagination.vue';
            import { Link, router } from '@inertiajs/vue3';

            let props = defineProps({
                filters: Object,
            });

            const filters = ref({

                numOfData: props.filters?.numOfData ?? 10,
            });

            const applyFilter = () => {
                router.get(route('backend.$lowercaseModel.index'), filters.value, { preserveState: true });
            };

            </script>

            <template>
                <BackendLayout>

                    <div class="row">
                    <!-- Column starts -->
                    <div class="col-xl-12">
                        <div class="card dz-card" id="bootstrap-table1">

                        <div class="card-header flex-wrap border-0">
                            <div>
                            <button type="button" class="btn px-3 py-2 btn-primary">
                                {{ \$page.props.pageTitle
                                }}<span class="badge text-bg-light ms-2 mb-0">{{ \$page.props.countedData }}</span>
                            </button>
                            </div>

                            <Link
                            :href="route('backend.$lowercaseModel.create')"
                            type="button"
                            class="btn px-4 btn-primary"
                            >
                            <span class="btn-icon-start text-info"
                                ><i class="fa fa-plus color-info"></i> </span
                            >Create
                            </Link>
                        </div>

                        <!--tab-content-->
                        <div class="tab-content" id="myTabContent">
                            <div
                            class="tab-pane fade active show"
                            id="Preview"
                            role="tabpanel"
                            aria-labelledby="home-tab"
                            >
                            <div class="card-body pt-0">
                                <div>
                                <div
                                    class="d-flex justify-content-between w-100 p-3 bg-light rounded"
                                >
                                    <div class="row w-100">
                                    <!-- Select Dropdown -->
                                    <div class="col-sm-4 col-md-6 d-md-block">
                                        <div class="col-sm-8 col-md-2">
                                        <select
                                            v-model="filters.numOfData"
                                            @change="applyFilter"
                                            class="form-control-sm form-select form-select-sm"
                                        >
                                            <option value="10">Show 10</option>
                                            <option value="20">Show 20</option>
                                            <option value="30">Show 30</option>
                                            <option value="40">Show 40</option>
                                            <option value="100">Show 100</option>
                                            <option value="150">Show 150</option>
                                            <option value="500">Show 500</option>
                                        </select>
                                        </div>
                                    </div>

                                    <!-- Input Field -->
                                    <div class="col-sm-8 col-md-6">
                                        <div class="d-flex gap-2 justify-content-end">
                                        <div class="col-sm-12 col-md-4">
                                            <input
                                            id="name"
                                            v-model="filters.name"
                                            class="form-control form-control-sm"
                                            type="text"
                                            placeholder="Search by $lowercaseModel name"
                                            @input="applyFilter"
                                            />
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="w-full my-3 overflow-x-auto">
                                    <BaseTable />
                                </div>

                                <Pagination />

                                </div>
                            </div>
                            <!-- /Recent Payments Queue -->
                            </div>
                        </div>
                        <!--/tab-content-->


                        </div>
                    </div>
                    </div>
                </BackendLayout>
            </template>


        EOT;

        return $code;
    }
    function Form($model, $table)
    {
        $relationshipDetails = DB::select("
            SELECT
                TABLE_NAME AS referencing_table,
                COLUMN_NAME AS foreign_key_column,
                REFERENCED_TABLE_NAME AS parent_table,
                REFERENCED_COLUMN_NAME AS parent_column
            FROM
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE
                TABLE_NAME = ?
                AND TABLE_SCHEMA = DATABASE()
                AND REFERENCED_TABLE_NAME IS NOT NULL
        ", [$table]);
        $lowercaseModel = strtolower($model);
        $code = <<<EOT
    <script setup>
    import { ref, onMounted } from "vue";
    import BackendLayout from "@/Layouts/BackendLayout.vue";
    import { Link, router, useForm, usePage } from "@inertiajs/vue3";
    import InputError from "@/Components/InputError.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import PrimaryButton from "@/Components/PrimaryButton.vue";
    import AlertMessage from "@/Components/AlertMessage.vue";
    import { displayResponse, displayWarning } from "@/responseMessage.js";

    const props = defineProps(["$lowercaseModel", "id", "countedData"
    EOT;
        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {
                $relationalTable = $relation->parent_table;

                $code .= <<<EOT
                                   , "$relationalTable"
                                EOT;
            }
        }

        $code .= <<<EOT
    
    ]);

    const form = useForm({
    EOT;

        $columnNames = Schema::getColumnListing($table);

        foreach ($columnNames as $columnName) {
            if (!in_array($columnName, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                $code .= <<<EOT

            $columnName: props.$lowercaseModel?.$columnName ?? "",

          EOT;
            }
        }

        $code .= <<<EOT
      imagePreview: props.$lowercaseModel?.image ?? "",
      filePreview: props.$lowercaseModel?.file ?? "",
      _method: props.$lowercaseModel?.id ? "put" : "post",
    });
    EOT;
        foreach ($columnNames as $columnName) {

            if ($columnName == 'image' || $columnName == 'images' || $columnName == 'photo') {
                $code .= <<<EOT
                const handleimageChange = (event) => {
                    const file = event.target.files[0];
                    form.$columnName = file;

                    // Display image preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        form.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    };
            EOT;
            }
        }
        foreach ($columnNames as $columnName) {

            if ($columnName == 'file' || $columnName == 'files') {
                $code .= <<<EOT
                const handlefileChange = (event) => {
                    const file = event.target.files[0];
                    form.$columnName = file;
                    };
            EOT;
            }
        }

        $code .= <<<EOT
    

    

    const submit = () => {
      const routeName = props.id
        ? route("backend.$lowercaseModel.update", props.id)
        : route("backend.$lowercaseModel.store");
      form
        .transform((data) => ({
          ...data,
          remember: "",
          isDirty: false,
        }))
        .post(routeName, {
          onSuccess: (response) => {
            if (!props.id) form.reset();
            displayResponse(response);
          },
          onError: (errorObject) => {
            displayWarning(errorObject);
          },
        });
    };
    </script>

    <template>
      <BackendLayout>
        <div class="row">
          <div class="col-xl-12">
            <div class="card" id="bootstrap-table1">
              <div class="card-header d-flex justify-content-between">
                <Link
                  :href="route('backend.$lowercaseModel.index')"
                  type="button"
                  class="btn btn-primary"
                >
                  View $model List <span
                                    class="badge text-bg-light ms-2 mb-0"
                                    >{{ countedData }}</span
                                >
                </Link>
              </div>
              <div class="card-body">
                <AlertMessage />
                <form @submit.prevent="submit">
                  <div class="row g-3">

    EOT;

        if ($relationshipDetails) {
            foreach ($relationshipDetails as $relation) {
                $foreign_key_column = $relation->foreign_key_column;
                $relationalTable = $relation->parent_table;
                $singularTable = Str::singular($relation->parent_table);
                $parentModel = ucfirst(Str::singular($relation->parent_table));
                $foreignTableColumn = Schema::getColumnListing($relationalTable);

                $code .= <<<EOT
                       <div class="col-md-6">
                                <div class="form-group">
                                    <label for="$foreign_key_column"
                                        >$parentModel</label
                                    >
                                    <select
                                        id="$foreign_key_column"
                                        class="form-control"
                                        v-model="form.$foreign_key_column"
                                    >
                                        <option value="">
                                            --Select $parentModel--
                                        </option>
                                        <template
                                            v-for="$singularTable in  $relationalTable"
                                        >
                                            <option
                                                :value="$singularTable.id"
                                            >
                    EOT;
                foreach ($foreignTableColumn as $col) {

                    if ($col == 'name' || $col == 'name_en') {
                        $code .= <<<EOT
                           
                            {{ $singularTable.$col }}
                        EOT;
                    } elseif ($col == 'title' || $col == 'title_en') {
                        $code .= <<<EOT
                           
                            {{ $singularTable.$col }}
                        EOT;
                    }
                }

                $code .= <<<EOT
                                                                                             
                                            </option>
                                        </template>
                                    </select>
                                    <InputError
                                        class="mt-2"
                                        :message="
                                            form.errors.$foreign_key_column
                                        "
                                    />
                                </div>
                            </div>

                    EOT;
            }
        }

        foreach ($columnNames as $columnName) {
            if (!in_array($columnName, ['id', 'created_at', 'updated_at', 'deleted_at', 'status'])) {
                $inputValue = ucfirst(str_replace('_', ' ', $columnName));

                if ($columnName == 'image' || $columnName == 'images' || $columnName == 'photo') {
                    $code .= <<<EOT

                <div class="col-md-6">
                  <InputLabel for="image" value="Image" />
                  <div v-if="form.imagePreview">
                    <img
                      :src="form.imagePreview"
                      alt="Photo Preview"
                      class="img-thumbnail mt-2"
                      height="60"
                      width="60"
                    />
                  </div>
                  <input
                    id="$columnName"
                    type="file"
                    accept="image/*"
                    class="form-control mt-2"
                    @change="handleimageChange"
                  />
                  <InputError class="mt-2" :message="form.errors.image" />
                </div>

                EOT;
                } elseif ($columnName == 'file' || $columnName == 'files') {
                    $code .= <<<EOT

                <div class="col-md-6">
                  <InputLabel for="file" value="File" />
                  <input
                    id="$columnName"
                    type="file"
                    accept="*/*"
                    class="form-control mt-2"
                    @change="handlefileChange"
                  />
                  <InputError class="mt-2" :message="form.errors.file" />
                </div>

                EOT;
                } else {

                    $isRelationColumn = false;

                    if ($relationshipDetails) {
                        foreach ($relationshipDetails as $relation) {
                            if ($columnName == $relation->foreign_key_column) {
                                $isRelationColumn = true;
                            }
                        }
                    }

                    if ($isRelationColumn) {
                        continue;
                    }

                    $code .= <<<EOT

                <div class="col-md-6">
                  <InputLabel for="$columnName" value="$inputValue" />
                  <input
                    id="$columnName"
                    class="form-control"
                    v-model="form.$columnName"
                    type="text"
                    placeholder="$inputValue"
                  />
                  <InputError class="mt-2" :message="form.errors.$columnName" />
                </div>

                EOT;
                }
            }
        }

        $code .= <<<EOT

                  </div>
                  <div class="d-flex justify-content-end mt-4">
                    <PrimaryButton
                      type="submit"
                      class="ms-4"
                      :class="{ 'opacity-25': form.processing }"
                      :disabled="form.processing"
                    >
                      {{ props.id ?? false ? "Update" : "Create" }}
                    </PrimaryButton>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </BackendLayout>
    </template>

    EOT;

        return $code;
    }
}
