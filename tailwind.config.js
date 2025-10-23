import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    prefix: "tw-",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#f97316",
                secondary: "#1e3a8a",
                ternary: "#f59e0b",
                "primary-contrast": "#ffffff",
                "secondary-contrast": "#ffffff",
                "ternary-contrast": "#1f2937",
                "secondary-light": "rgba(30, 58, 138, 0.12)",
                surface: "#ffffff",
                muted: "#f8fafc",
            },
        },
    },

    plugins: [forms],
};
