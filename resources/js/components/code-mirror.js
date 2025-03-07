import { EditorState } from '@codemirror/state';
import { indentWithTab, history, defaultKeymap, historyKeymap } from '@codemirror/commands';
import { indentOnInput, indentUnit, bracketMatching, syntaxHighlighting, defaultHighlightStyle } from '@codemirror/language';
import { closeBrackets, closeBracketsKeymap } from '@codemirror/autocomplete';
import { highlightActiveLine, keymap, EditorView, lineNumbers } from '@codemirror/view';
import { oneDark } from "@codemirror/theme-one-dark";
import languages from '../editor-languages';

const darkMode = document.documentElement.classList.contains('dark');

Alpine.data('codemirror', (data) => ({
    ...data,
    editor: null,
    init() {
        this.editor = new EditorView({
            state: EditorState.create({
                doc: this.value,
                extensions: [
                    history(),
                    lineNumbers(),
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
                    languages[this.language] ? languages[this.language]() : null,
                    syntaxHighlighting(defaultHighlightStyle, { fallback: true }),
                    ...(darkMode ? [oneDark] : []),
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
