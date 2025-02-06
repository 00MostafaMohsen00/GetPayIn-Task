<template>
    <div
        class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dar:text-gray-300 mb-2"
    >
        <div class="font-medium text-gray-500 mb-1">
            <slot name="title"></slot>
        </div>
        <slot></slot>
    </div>
</template>
