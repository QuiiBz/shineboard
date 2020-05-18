export const saveCaretPosition = (context) => {

    const selection = window.getSelection();

    try {

        const range = selection.getRangeAt(0);
        range.setStart(  context, 0 );
        const len = range.toString().length;

        return () => {

            const pos = getTextNodeAtPosition(context, len);
            selection.removeAllRanges();
            const range = new Range();
            range.setStart(pos.node ,pos.position);
            selection.addRange(range);
        }

    } catch(error) {

        return () => console.warn('Not range at index "0"');
    }
}

const getTextNodeAtPosition = (root, index) => {

    let lastNode = null;

    const treeWalker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, (elem) => {

        if(index > elem.textContent.length) {

            index -= elem.textContent.length;
            lastNode = elem;
            return NodeFilter.FILTER_REJECT
        }

        return NodeFilter.FILTER_ACCEPT;
    });

    const c = treeWalker.nextNode();

    return {

        node: c ? c: root,
        position: index
    };
}
