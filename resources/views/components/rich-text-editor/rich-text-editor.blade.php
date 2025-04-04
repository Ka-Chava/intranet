<div
    class="rte-editor"
    x-data="new RichTextEditor(@this, '{{ $attributes->wire('model')->value() }}')"
    x-init="() => setup($refs.editor, {{ json_encode($attributes->whereStartsWith(['placeholder'])) }})"
    wire:ignore
    {{ $attributes->whereDoesntStartWith(['wire:model', 'placeholder']) }}
>
    <div class="rte-editor__container">
        <div class="rte-toolbar">
            <div class="rte-toolbar__block">
                <x-dropdown class="rte-toolbar__dropdown">
                    <x-slot:trigger>
                        <div class="button button--small rte-toolbar__button">
                            <span x-text="getSelectedNode(updatedAt)"></span>

                            <x-icon-micro-chevron class="w-4 h-4" />
                        </div>
                    </x-slot:trigger>

                    <div class="menu rte-toolbar__menu">
                        <button
                            type="button"
                            class="button menu__item"
                            :class="{ 'active': isActive('bold', {}, updatedAt) }"
                            @click="editor().chain().focus().setParagraph().run()"
                            x-text="'Normal text'"
                        ></button>

                        @foreach(range(1, 6) as $index)
                            <button
                                type="button"
                                class="button menu__item rte-toolbar__menu-item"
                                :class="{ 'active': isActive('heading', { level: {{ $index }} }, updatedAt) }"
                                @click="setHeading({{ $index }})"
                                x-text="'Heading {{ $index }}'"
                            ></button>
                        @endforeach
                    </div>
                </x-dropdown>
            </div>

            <div class="rte-toolbar__block">
                <button
                    type="button"
                    class="button rte-toolbar__button"
                    :disabled="isActive('codeBlock', {}, updatedAt)"
                    :class="{ 'active': isActive('bold', {}, updatedAt) }"
                    @click="toggleBold()"
                >
                    <x-heroicon-o-bold class="w-4 h-4" />
                </button>

                <button
                    type="button"
                    class="button rte-toolbar__button"
                    :disabled="isActive('codeBlock', {}, updatedAt)"
                    :class="{ 'active': isActive('italic', {}, updatedAt) }"
                    @click="toggleItalic()"
                >
                    <x-heroicon-o-italic class="w-4 h-4" />
                </button>

                <x-dropdown class="rte-toolbar__dropdown">
                    <x-slot:trigger>
                        <div class="button button--small rte-toolbar__button">
                            <x-heroicon-o-ellipsis-horizontal class="w-4 h-4" />
                        </div>
                    </x-slot:trigger>

                    <div class="menu rte-toolbar__menu">
                        <button
                            type="button"
                            class="button menu__item rte-toolbar__menu-item"
                            :disabled="isActive('codeBlock', {}, updatedAt)"
                            :class="{ 'active': isActive('underline', {}, updatedAt) }"
                            x-text="'Underline'"
                            @click="toggleUnderline()"
                        ></button>

                        <button
                            type="button"
                            class="button menu__item rte-toolbar__menu-item"
                            :disabled="isActive('codeBlock', {}, updatedAt)"
                            :class="{ 'active': isActive('strike', {}, updatedAt) }"
                            @click="toggleStrike()"
                            x-text="'Strikethrough'"
                        ></button>

                        <button
                            type="button"
                            class="button menu__item rte-toolbar__menu-item"
                            :class="{ 'active': isActive('codeBlock', {}, updatedAt) }"
                            @click="toggleCodeBlock()"
                            x-text="'Code'"
                        ></button>

                        <span class="menu__divider"></span>

                        <button
                            type="button"
                            class="button menu__item rte-toolbar__menu-item"
                            :disabled="!hasMarks(updatedAt)"
                            @click="clearMarks()"
                            x-text="'Clear formatting'"
                        ></button>
                    </div>
                </x-dropdown>
            </div>

            <div class="rte-toolbar__block">
                <label for="editor-color">
                    <span class="button button--small rte-toolbar__button">
                        <span class="rte-toolbar__color" :style="{ 'border-color': getSelectedColor(updatedAt) }">A</span>

                        <x-icon-micro-chevron class="w-4 h-4" />
                    </span>

                    <input
                        type="color"
                        id="editor-color"
                        class="sr-only"
                        @input="setColor($event.target.value)"
                        x-bind:value="getSelectedColor(updatedAt)"
                    />
                </label>
            </div>

            <div class="rte-toolbar__block">
                <button
                    type="button"
                    class="button rte-toolbar__button"
                    :class="{ 'active': isActive('bulletList', {}, updatedAt) }"
                    @click="editor().chain().focus().toggleBulletList().run()"
                >
                    <x-heroicon-o-list-bullet class="w-4 h-4" />
                </button>

                <button
                    type="button"
                    class="button rte-toolbar__button"
                    :class="{ 'active': isActive('orderedList', {}, updatedAt) }"
                    @click="editor().chain().focus().toggleOrderedList().run()"
                >
                    <x-heroicon-o-numbered-list class="w-4 h-4" />
                </button>
            </div>

            <div class="rte-toolbar__block">
                <x-dropdown class="rte-toolbar__dropdown rte-toolbar__dropdown--end">
                    <x-slot:trigger>
                        <div class="button button--small rte-toolbar__button" @click="setUrlAndTitleFromSelection()">
                            <x-heroicon-o-link class="w-4 h-4" />
                        </div>
                    </x-slot:trigger>

                    <div class="menu rte-toolbar__link">
                        <input type="text" x-model="editableLinkUrl" placeholder="Paste link" class="form__control" />
                        <input type="text" x-model="editableLinkTitle" placeholder="Display text (optional)" class="form__control" />

                        <button type="button" class="button button--primary" @click="setLink()">
                            Save
                        </button>
                    </div>
                </x-dropdown>

                <button
                    x-show="getSelectedLink(updatedAt)"
                    type="button"
                    class="button rte-toolbar__button"
                    @click="unlink()"
                >
                    <x-heroicon-o-link-slash class="w-4 h-4" />
                </button>
            </div>
        </div>

        <div x-ref="editor"></div>
    </div>
</div>
