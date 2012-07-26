/*
 * File: app/view/DetailsPanel.js
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

Ext.define('CatHerder.view.categoryDetails', {
    extend: 'Ext.Panel',
    alias: 'widget.categorydetails',
    config: {
        tpl: 'Name: {name}<br />Contains {[values.items.length]} Item(s)',
        scrollable: true,
        items: [
            {
                xtype: 'titlebar',
                docked: 'top',
                title: 'Category Name Here',
                items: [
                    {
                        xtype: 'button',
                        ui: 'back',
                        text: 'Back',
                        id: 'BackToCategoryButton'
                    },
                    {
                        xtype: 'button',
                        text: 'Edit',
                        id: 'editCategoryButton',
                        align: 'right'
                    }
                ]
            }
        ],
        listeners: [
            {
                fn: 'onEditCategoryTap',
                event: 'tap',
                delegate: '#editCategoryButton'
            }, {
                fn: 'onBackCategoryTap',
                event: 'tap',
                delegate: '#BackToCategoryButton'
            }
        ]
    },
    onEditCategoryTap: function(button, e, options) {
        var tabs = button.up('tabpanel');
        var current = tabs.getActiveItem();
        console.log(current);
        var details = current.getActiveItem();
        var rec = details.getRecord();
        console.log(rec);
        current.setActiveItem(1);
        var form = current.getActiveItem();
        form.setRecord(rec);
    },
    onBackCategoryTap: function(button, e, options) {
        var tabs = button.up('tabpanel');
        var current = tabs.getActiveItem();
        current.setActiveItem(0);
    }

});