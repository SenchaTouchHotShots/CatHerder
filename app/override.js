Ext.DataView.override({
    prepareAssociatedData: function(record, ids) {
            //we keep track of all of the internalIds of the models that we have loaded so far in here
            ids = ids || [];


            var associations     = record.associations.items,
                associationCount = associations.length,
                associationData  = {},
                i = 0,
                j = 0,
                associatedInstance, associatedRecords, associatedRecord,
                associatedRecordCount, association, internalId;


            for (; i < associationCount; i++) {
                association = associations[i];


                if (association.type == "hasMany") {
                    //this is the hasMany store filled with the associated data
                    associatedInstance = record[association.storeName];


                    //we will use this to contain each associated record's data
                    associationData[association.name] = [];


                    //if it's loaded, put it into the association data
                    if (associatedInstance && associatedInstance.data.length > 0) {
                        associatedRecords = associatedInstance.data.items;
                        associatedRecordCount = associatedRecords.length;


                        //now we're finally iterating over the records in the association. We do this recursively
                        for (; j < associatedRecordCount; j++) {
                            associatedRecord = associatedRecords[j];
                            internalId = associatedRecord.internalId;


                            //when we load the associations for a specific model instance we add it to the set of loaded ids so that
                            //we don't load it twice. If we don't do this, we can fall into endless recursive loading failures.
                            if (ids.indexOf(internalId) == -1) {
                                ids.push(internalId);


                                associationData[association.name][j] = associatedRecord.data;
                                Ext.apply(associationData[association.name][j], this.prepareAssociatedData(associatedRecord, ids));
                            }
                        }
                    }
		} else if (association.type == "belongsTo") {
                var foreignKeyId = record.data[association.foreignKey];
                var storeName = association.associatedName;
                record.data[association.name] = Ext.getStore(storeName).getById(foreignKeyId);
                } else if (association.type == "hasOne") {
                    //this is the to-one record instance
                    associatedInstance = record[association.instanceName];


                    //if it's loaded, put it into the association data
                    if (associatedInstance) {
                        associationData[association.name] = associatedInstance.data;
                        Ext.apply(associationData[association.name], this.prepareAssociatedData(associatedInstance, ids));
                    }
                }
            }


            return associationData;
        }
});