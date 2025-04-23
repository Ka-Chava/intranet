import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Mention from '@tiptap/extension-mention';
import Underline from '@tiptap/extension-underline';
import Link from '@tiptap/extension-link';
import { Color } from '@tiptap/extension-color';
import ListKeymap from '@tiptap/extension-list-keymap';
import Placeholder from '@tiptap/extension-placeholder';
import TextStyle from '@tiptap/extension-text-style'

export default class RichTextEditor {
    constructor(livewire, model) {
        this.model = model;
        this.livewire = livewire;
        this.content = livewire.get(model);
        this.editableLinkTitle = null;
        this.editableLinkUrl = null;
    };

    setup(element, config = {}) {
        const {placeholder, id, name} = config;
        let editors = window.Editors || {};
        this.updatedAt = Date.now();

        this.id = id || new Date().getTime();

        editors[this.id] = new Editor({
            element: element,
            editorProps: {
                attributes: {
                    id,
                    name,
                    class: 'editor',
                },
            },
            extensions: [
                StarterKit.configure({
                    bulletList: {
                        keepMarks: true,
                        keepAttributes: true,
                    },
                    orderedList: {
                        keepMarks: true,
                        keepAttributes: true,
                    },
                }),
                Mention,
                Underline,
                Link.configure({
                    openOnClick: false,
                    defaultProtocol: 'https',
                    protocols: ['http', 'https'],
                    isAllowedUri: (url, ctx) => {
                        try {
                            const parsedUrl = url.includes(':') ? new URL(url) : new URL(`${ctx.defaultProtocol}://${url}`);

                            if (!ctx.defaultValidate(parsedUrl.href)) {
                                return false;
                            }

                            const disallowedProtocols = ['ftp', 'file', 'mailto'];
                            const protocol = parsedUrl.protocol.replace(':', '');

                            if (disallowedProtocols.includes(protocol)) {
                                return false;
                            }

                            const allowedProtocols = ctx.protocols.map(p => (typeof p === 'string' ? p : p.scheme));

                            return allowedProtocols.includes(protocol);
                        } catch {
                            return false;
                        }
                    },
                }),
                Color,
                TextStyle,
                ListKeymap,
                Placeholder.configure({
                    placeholder,
                }),
            ],
            content: null,
            onUpdate: ({ editor }) => {
                this.livewire.set(this.model, editor.getHTML());
            },
            onTransaction: () => {
                this.updatedAt = Date.now();
            },
        });

        window.Editors = editors;

        this.$watch('content', (content) => {
            if (content === this.editor().getHTML()) return;
            this.editor().commands.setContent(content, false);
        });
    };

    editor() {
        return (window.Editors || {})[this.id];
    };

    setHeading(level) {
        this.editor().chain().setHeading({ level }).focus().run();
    };

    setColor(color) {
        this.editor().chain().focus().setColor(color).run();
    };

    setLink() {
        if (!this.editableLinkUrl) return;

        try {
            const url = new URL(this.editableLinkUrl);
            const title = this.editableLinkTitle;

            const pos = this.editor().state.selection.from;

            this.editor()
                .chain()
                .focus()
                .insertContent(title)
                .setTextSelection({ from: pos, to: pos + title.length })
                .setLink({ href: url.href })
                .run();
        } catch {
        } finally {
            this.editableLinkTitle = null;
            this.editableLinkUrl = null;
        }
    };

    setUrlAndTitleFromSelection() {
        const selectedText = this.editor().state.selection.$anchor.node().textContent;
        const link = this.editor().getAttributes('link');

        if (link.href) {
            this.editableLinkUrl = link.href;
            this.editableLinkTitle = selectedText || link.href;
        } else {
            this.editableLinkUrl = '';
            this.editableLinkTitle = '';
        }
    }

    unlink() {
        this.editor().chain().focus().unsetLink().run();
    };

    toggleBold() {
        this.editor().chain().toggleBold().focus().run();
    };

    toggleItalic() {
        this.editor().chain().toggleItalic().focus().run();
    };

    toggleUnderline() {
        this.editor().chain().toggleUnderline().focus().run();
    };

    toggleStrike() {
        this.editor().chain().toggleStrike().focus().run();
    };

    toggleCodeBlock() {
        this.editor().chain().toggleCodeBlock().focus().run();
    };

    isActive(type, opts = {}, _) {
        return this.editor().isActive(type, opts);
    };

    hasMarks(_) {
        return [
            this.isActive('codeBlock', {}, _),
            this.isActive('bold', {}, _),
            this.isActive('italic', {}, _),
            this.isActive('underline', {}, _),
            this.isActive('strike', {}, _),
            this.editor().getAttributes('textStyle').color,
        ].some(Boolean);
    };

    clearMarks() {
        this.editor().commands.unsetAllMarks();
        this.editor().chain().focus().unsetColor().run();
        if (this.isActive('codeBlock', {})) {
            this.toggleCodeBlock();
        }
    };

    getSelectedNode(_) {
        const heading = Array(6)
            .fill(0)
            .map((_, i) =>  {
                if (this.isActive('heading', { level: i + 1 })) {
                    return `Heading ${i + 1}`;
                }
            })
            .filter(Boolean)
            .shift();

        if (heading) {
            return heading;
        } else {
            return 'Normal text';
        }
    };

    getSelectedColor(_) {
        return this.editor().getAttributes('textStyle').color;
    };

    getSelectedLink(_) {
        return this.editor().getAttributes('link').href || null;
    };
}
