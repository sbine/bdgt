'use strict'

module.exports = function () {
  return {
    framework: 'tailwind',
    table: 'table',
    row: 'table--row',
    column: 'table--col',
    label: '',
    input: 'input-text',
    select: 'input-text',
    field: '',
    inline: 'inline',
    right: 'float-right',
    left: 'float-left',
    center: 'text-center',
    contentCenter: 'justify-center',
    nomargin: 'm-0',
    groupTr: 'table-info',
    small: 'text-sm',
    button: 'button',
    dropdown: {
      container: 'dropdown',
      trigger: 'dropdown-toggle',
      menu: 'dropdown-menu',
      content: '',
      item: 'dropdown-item',
      caret: 'caret',
    },
    pagination: {
      nav: '',
      count: '',
      wrapper: '',
      list: '',
      item: '',
      link: 'link',
      next: '',
      prev: '',
      active: 'active',
      disabled: 'disabled',
    },
  }
}
