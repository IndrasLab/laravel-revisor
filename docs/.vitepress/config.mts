import {defineConfig} from "vitepress";

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "Laravel Revisor",
    description: "Revisor is a robust versioning and publishing system for Laravel Eloquent Models.",
    cleanUrls: true,
    themeConfig: {
        // logo: {
        //     light: '/assets/IndraCube1-light.svg',
        //     dark: '/assets/IndraCube1.svg',
        // },
        // https://vitepress.dev/reference/default-theme-config
        nav: [
            {text: "IndraCollective", link: "https://indracollective.dev"},
            // {text: "Home", link: "/"},
            // {text: "Docs", link: "/introduction"},
            // { text: "Support Us", link: "https://indracollective.dev/support" },
        ],

        sidebar: [
            {
                items: [
                    {
                        text: "Getting Started",
                        items: [
                            {text: "Introduction", link: "/introduction"},
                            {text: "Installation", link: "/installation"},
                            {text: "Configuration", link: "/configuration"},
                        ],
                    },
                    {
                        text: "Usage",
                        items: [
                            {text: "Preparing your Models", link: "/preparing-your-models"},
                            {text: "Modes & Middleware", link: "/modes-and-middleware"},
                            {text: "Publishing", link: "/publishing"},
                            {text: "Versioning", link: "/versioning"}
                        ],
                    },
                ],
            },
        ],

        socialLinks: [
            {icon: "github", link: "https://github.com/indracollective/laravel-revisor"},
            {icon: "twitter", link: "https://twitter.com/livesourcenz"},
        ],
        footer: {
            message: "Released under the MIT License.",
            copyright: 'Copyright © 2024-present <a href="https://indracollective.dev">IndraCollective</a>',
        },
    },
});
