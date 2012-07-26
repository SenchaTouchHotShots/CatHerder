/*
 * File: app/view/categoryList.js
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

Ext.define('CatHerder.view.categoryList', {
    extend:'Ext.dataview.List',
    alias:'widget.categorylist',

    config:{
        id:'categoryList',
        store:'categoryStore',
        itemTpl:[
            '<div>{name} -- {[values.items.length]} item(s)</div>'
        ],
        listeners:[
            {
                fn:'onCategorySwipe',
                event:'itemswipe'
            },
            {
                fn:'onCategoryTapHold',
                event:'itemtaphold'
            },
            {
                fn:'onCategorySingletap',
                event:'itemsingletap'
            }
        ],
        isDeleting:false
    },
    deleteItem:function (record) {
        Ext.Msg.confirm('Please Confirm', 'Are you sure you want to delete this Category?',
            function () {
                this.delRecord.erase();
                this.delRecord = false;
                this.isDeleting = false;
            }, this);
    },

    onCategorySwipe:function (dataview, index, target, record) {
        var delBtn = target.down('.delete');
        this.delRecord = record;
        delBtn.on('tap', function (evt) {
            evt.preventDefault();
            this.deleteItem();
        }, dataview, {
            single:true
        });
        delBtn.removeCls('hidden');
        delBtn.addCls('shown');

        if (this.isDeleting) {
            //Hide other delete button.
            this.isDeleting.addCls('hidden');
            this.isDeleting.removeCls('shown');
            if (this.isDeleting == delBtn) {
                this.isDeleting = false;
                this.delRecord = false;
            }
        } else {
            this.isDeleting = delBtn;
        }

        return true;
    },

    onCategoryTaphold:function (dataview, index, target, record, e, options) {
        console.log('Category Tap Hold');
    },

    onCategorySingletap:function (dataview, index, target, record, e, options) {
        console.log('Category Single Tap');
        var cards = dataview.up('container');
        cards.setActiveItem(2);
        console.log(record.data);
        var details = cards.getActiveItem();
        details.down('titlebar').setTitle(record.data.name);
        details.setRecord(record);
    }

});