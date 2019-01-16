//import Editor from 'tui-editor';
import Editor from 'tui-editor/dist/tui-editor-Editor-all.js';

export const editor = new Editor({
	el: document.querySelector('#edit-section'),
	//viewer: true,
	initialEditType: 'markdown',
	useCommandShortcut: true,
	previewStyle: 'vertical',
	height: '100%',
	initialValue: '',
	language: 'ja',
	toolbarItems: [
		'heading',
		'bold',
		'italic',
		'strike',
		'divider',
		'hr',
		'quote',
		'divider',
		'ul',
		'ol',
		'task',
		'indent',
		'outdent',
		'divider',
		'table',
		// 'image',
		'link',
		'divider',
		'code',
		'codeblock'
	],
	exts: ['scrollSync', 'colorSyntax', 'uml', 'chart', 'mark', 'table'],
});
