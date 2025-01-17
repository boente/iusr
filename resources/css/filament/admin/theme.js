import { EditorState } from '@codemirror/state';
import { indentWithTab, history, defaultKeymap, historyKeymap } from '@codemirror/commands';
import { indentOnInput, indentUnit, bracketMatching, syntaxHighlighting, defaultHighlightStyle } from '@codemirror/language';
import { closeBrackets, closeBracketsKeymap } from '@codemirror/autocomplete';
import { highlightActiveLine, keymap, EditorView } from '@codemirror/view';
import { oneDark } from "@codemirror/theme-one-dark";
import { javascript } from "@codemirror/lang-javascript";
import { r } from "codemirror-lang-r";

Alpine.data('codemirror', (data) => ({
    ...data,
    editor: null,
    init() {
        this.editor = new EditorView({
            state: EditorState.create({
                doc: this.value,
                extensions: [
                    history(),
                    indentUnit.of("    "),
                    indentOnInput(),
                    bracketMatching(),
                    closeBrackets(),
                    highlightActiveLine(),
                    keymap.of([
                        indentWithTab,
                        ...closeBracketsKeymap,
                        ...defaultKeymap,
                        ...historyKeymap,
                    ]),
                    // javascript(),
                    r(),
                    syntaxHighlighting(defaultHighlightStyle, { fallback: true }),
                    oneDark,
                    EditorView.updateListener.of((update) => {
                        if (update.docChanged) {
                            this.$dispatch('input', this.editor.state.doc.toString());
                        }
                    }),
                ],
            }),
            parent: this.$root,
        });
    },
}));
