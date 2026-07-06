import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        // heroicons blade package (pour que les classes des icônes soient bien scannées)
        "./vendor/blade-ui-kit/blade-heroicons/resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                bj: {
                    violet: "#582A73", // violet principal
                    "violet-dk": "#3D1F4F", // violet foncé (secondaire)
                    "violet-2a": "#2A1B38", // variante très sombre
                    or: "#FAD698", // or clair
                    "or-dk": "#E7B96B", // or foncé (accents)
                    creme: "#F7F4EF", // fond crème
                    noir: "#1A1A1A",
                    violet:      '#4A2461',  // ← ta nouvelle couleur
                    wa: "#25D366", // WhatsApp
                },
            },
            fontFamily: {
                sans: ["Questrial", "Arial", ...defaultTheme.fontFamily.sans],
                display: [
                    '"Bricolage Grotesque"',
                    ...defaultTheme.fontFamily.sans,
                ],
                serif: ["Fraunces", ...defaultTheme.fontFamily.serif],
                script: ['"Great Vibes"', "cursive"],
            },
        },
    },

    plugins: [forms],
};
