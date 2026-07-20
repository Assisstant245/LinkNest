import Sortable from 'sortablejs';

window.initElementsSortable = function (el) {
    Sortable.create(el, {
        group: { name: 'blocks', pull: 'clone', put: false },
        sort: false,
        animation: 150,
    });
};

window.initCanvasSortable = function (el, wire) {
    Sortable.create(el, {
        group: { name: 'blocks', pull: true, put: true },
        handle: '[data-drag-handle]',
        animation: 150,
        onAdd(evt) {
            const type = evt.item.dataset.type;
            const index = evt.newIndex;

            evt.item.remove();

            if (type) {
                wire.addBlockAt(type, index);
            }
        },
        onUpdate() {
            const orderedIds = Array.from(el.children)
                .map((child) => child.dataset.id)
                .filter(Boolean);

            wire.reorder(orderedIds);
        },
    });
};
