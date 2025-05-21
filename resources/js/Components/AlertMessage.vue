<template>
    <div>
        <!-- Success Message -->
        <div v-if="$page.props.flash.successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $page.props.flash.successMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <!-- Error Message -->
        <div v-if="$page.props.flash.errorMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $page.props.flash.errorMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <!-- Warning Message -->
        <div v-if="$page.props.flash.warningMessage" class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $page.props.flash.warningMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <!-- Uncomment and adapt if you need to display errorBags -->
        <!-- 
        <template v-if="$page.props.errorBags" v-for="errorKey in Object.keys($page.props.errorBags.default)">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $page.props.errorBags.default[errorKey] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </template>
        -->
    </div>
</template>

