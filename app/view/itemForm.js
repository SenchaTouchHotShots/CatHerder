/*
 * File: app/view/itemForm.js
 *
 * This file was generated by Sencha Architect version 2.0.0.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Sencha Touch 2.0.x library, under independent license.
 * License of Sencha Architect does not include license for Sencha Touch 2.0.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('CatHerder.view.itemForm', {
    extend: 'Ext.form.Panel',
    alias: 'widget.itemform',
    config: {
        items: [
            {
                xtype: 'container',
                html: 'Please enter the item information below:',
                id: 'itemText',
                margin: 8,
                style: 'text-align:center;'
            },
            {
                xtype: 'textfield',
                id: 'itemName',
                label: 'Name'
            },
            {
                xtype: 'selectfield',
                id: 'itemCategory',
                margin: '8 0 8 0',
                label: 'Category',
                store: 'categoryStore'
            },
            {
                xtype: 'textfield',
                id: 'itemPrice',
                margin: '8 0 8 0',
                label: 'Price'
            },
            {
                xtype: 'urlfield',
                id: 'itemPhoto',
                margin: '8 0 8 0',
                label: 'Photo',
                placeHolder: 'http://example.com'
            },
            {
                xtype: 'textareafield',
                id: 'itemDescription',
                label: 'Description'
            },
            {
                xtype: 'button',
                margin: 8,
                ui: 'confirm',
                text: 'Save'
            },
            {
                xtype: 'button',
                margin: 8,
                ui: 'decline',
                text: 'Cancel'
            },
            {
                xtype: 'hiddenfield',
                id: 'itemID'
            }
        ]
    }

});