<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import {
    displayResponse,
    displayWarning,
    errorMessage,
} from "@/responseMessage.js";
const { props } = usePage();

// Login Type Toggle
const loginType = ref("admin"); // 'admin' or 'employee'

// Admin Form
const adminForm = useForm({
    email: "admin@gmail.com",
    password: "12345678",
    remember: false,
});

// Employee Form
const employeeForm = useForm({
    employee_id: "E-001",
    password: "12345678",
    remember: false,
});

// Admin Login Submission
const submitAdmin = () => {
    adminForm
        .transform((data) => ({
            ...data,
            remember: adminForm.remember ? "on" : "",
        }))
        .post(route("backend.auth.login"), {
            onSuccess: (response) => {
                adminForm.reset("password");

                if (response.props.errorMessage) {
                    errorMessage(response.props.errorMessage);
                } else {
                    displayResponse(response);
                }
            },
            onError: (errorObject) => {
                displayWarning(errorObject);
            },
        });
};

// Employee Login Submission
const submitEmployee = () => {
    employeeForm
        .transform((data) => ({
            ...data,
            remember: employeeForm.remember ? "on" : "",
        }))
        .post(route("backend.employee.employee_login"), {
            onSuccess: (response) => {
                employeeForm.reset("password");
                if (response.props.errorMessage) {
                    errorMessage(response.props.errorMessage);
                } else {
                    displayResponse(response);
                }
            },
            onError: (errorObject) => {
                displayWarning(errorObject);
            },
        });
};
</script>

<template>
    <div class="login-container">
        <div class="login-form-box">
            <h1 class="text-center ">Login</h1>
            <hr>

            <div>
                <div class="login-toggle">
                <div
                    :class="['toggleButton', { active: loginType === 'admin' }]"
                    @click="loginType = 'admin'"
                >
                    Admin Login
                </div>
                <div
                    :class="[
                        'toggleButton',
                        { active: loginType === 'employee' },
                    ]"
                    @click="loginType = 'employee'"
                >
                    Employee Login
                </div>
            </div>

            <!-- Admin Login Form -->
            <div v-if="loginType === 'admin'" class="form-box">
                <form @submit.prevent="submitAdmin">
                    <div class="form-group">
                        <label for="admin-email">Email</label>
                        <input
                            id="admin-email"
                            v-model="adminForm.email"
                            type="email"
                            required
                            autofocus
                        />
                    </div>
                    <div class="form-group">
                        <label for="admin-password">Password</label>
                        <input
                            id="admin-password"
                            v-model="adminForm.password"
                            type="password"
                            required
                        />
                    </div>
                    <div class="form-footer">
                        <button
                            type="submit"
                            class="submit-button"
                            :disabled="adminForm.processing"
                        >
                            Log in
                        </button>
                    </div>
                </form>
            </div>

            <!-- Employee Login Form -->
            <div v-if="loginType === 'employee'" class="form-box">
                <form @submit.prevent="submitEmployee">
                    <div class="form-group">
                        <label for="employee-id"
                            >Employee ID or Mobile No</label
                        >
                        <input
                            id="employee-id"
                            v-model="employeeForm.employee_id"
                            type="text"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="employee-password">Password</label>
                        <input
                            id="employee-password"
                            v-model="employeeForm.password"
                            type="password"
                            required
                        />
                    </div>
                    <div class="form-footer">
                        <button
                            type="submit"
                            class="submit-button"
                            :disabled="employeeForm.processing"
                        >
                            Log in
                        </button>
                    </div>
                </form>
            </div>
            </div>


        </div>
    </div>
</template>

<style scoped>
.login-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url("../../../public/images/login/bg-06.jpg");
    background-repeat: no-repeat; /* Prevents the image from repeating */
    background-position: center; /* Centers the image */
    padding: 20px;
    background-size: cover;
}
/* .login-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(255, 255, 255);
    opacity: .3;
    filter: blur(10px);
    z-index: 1;
} */

.login-form-box {
    position: absolute;
    width: 100%;
    max-width: 420px;
    background-color: rgba(255, 255, 255, 0.2);
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    z-index: 999;
    border: 2px solid #321F69;
}

h1 {
    font-size: 2.5rem;
    color: #2e3b4e;
    font-weight: 700;

    text-align: center;
    letter-spacing: 1px;
}

.login-toggle {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;

}

.toggleButton {
    padding: 12px 24px;
    margin: 0 10px;
    border-radius: 10px;
    background-color: #ffffff;
    color: #2e3b4e;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.toggleButton.active {
    background-color: #321F69;
    color: white;
    box-shadow: 0 5px 15px rgba(46, 59, 78, 0.3);
}
.toggleButton.active:hover {
    background-color: #59419f;
    color: white;
    box-shadow: 0 5px 15px rgba(46, 59, 78, 0.3);
}

.toggleButton:hover {
    background-color: #f1f1f1;
    transform: translateY(-2px);
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    font-size: 14px;
    color: #777;
    margin-bottom: 8px;
    font-weight: 600;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 14px 20px;
    border: 2px solid #ddd;
    border-radius: 10px;
    font-size: 15px;
    margin-bottom: 18px;
    transition: all 0.3s ease;
    background-color: #fafafa;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #2e3b4e;
    outline: none;
    box-shadow: 0 4px 15px rgba(46, 59, 78, 0.1);
}

.submit-button {
    width: 100%;
    padding: 10px;
    background-color: #321F69;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 18px;

    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(46, 59, 78, 0.15);
}

.submit-button:disabled {
    background-color: #b0bec5;
    cursor: not-allowed;
}

.submit-button:hover {
    background-color: #1f2c36;
    transform: translateY(-2px);
}

.form-footer {
    display: flex;
    justify-content: center;
    margin-top: 25px;
}

@media (max-width: 768px) {
    .login-form-box {
        width: 100%;
        padding: 25px;
    }
}
</style>
