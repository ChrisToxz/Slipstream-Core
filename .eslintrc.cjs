module.exports = {
    extends: ['eslint:recommended', 'plugin:vue/vue3-recommended'],
    parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
    },
    globals: {
        '$snackbar': true,
        'route': true,
        'axios': true,
    },
    env: {
        amd: true,
        browser: true,
        es6: true,
    },
    overrides: [
        {
            'files': [
                '.eslintrc.{js,cjs}',
            ],
            'parserOptions': {
                'sourceType': 'script',
            },
        },
        {
            files: ['*.vue'],
            rules: {
                'vue/html-indent': ['error', 4],
                'vue/script-indent': ['error', 4],
                'vue/html-closing-bracket-newline': [
                    {
                        singleline: 'ignore',
                        multiline: 'ignore',
                    },
                ],
            }
        }
    ],
    plugins: [
        'vue',
    ],
    rules: {
        indent: ['error', 4],
        quotes: ['warn', 'single'],
        semi: ['warn', 'never'],
        'no-unused-vars': ['error', { vars: 'all', args: 'after-used', ignoreRestSiblings: true }],
        'vue/multi-word-component-names': 'off',
        'vue/max-attributes-per-line': 'off',
        'vue/no-v-html': 'off',
        'vue/require-default-prop': 'off',
        'vue/singleline-html-element-content-newline': 'off',
        'vue/html-self-closing': [
            'warn',
            {
                html: {
                    void: 'always',
                    normal: 'always',
                    component: 'always',
                },
            },
        ],
        'vue/no-v-text-v-html-on-component': 'off',
    },
}
