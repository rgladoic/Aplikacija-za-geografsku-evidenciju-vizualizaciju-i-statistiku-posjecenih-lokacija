var wms_layers = [];

var format_Hrvatska_0 = new ol.format.GeoJSON();
var features_Hrvatska_0 = format_Hrvatska_0.readFeatures(json_Hrvatska_0, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_Hrvatska_0 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Hrvatska_0.addFeatures(features_Hrvatska_0);
var lyr_Hrvatska_0 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_Hrvatska_0, 
                style: style_Hrvatska_0,
                interactive: true,
                title: '<img src="styles/legend/Hrvatska_0.png" /> Hrvatska'
            });
var format_Parkovi_1 = new ol.format.GeoJSON();
var features_Parkovi_1 = format_Parkovi_1.readFeatures(json_Parkovi_1, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_Parkovi_1 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Parkovi_1.addFeatures(features_Parkovi_1);
var lyr_Parkovi_1 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_Parkovi_1, 
                style: style_Parkovi_1,
                interactive: true,
                title: '<img src="styles/legend/Parkovi_1.png" /> Parkovi'
            });
var format_Gradovi_2 = new ol.format.GeoJSON();
var features_Gradovi_2 = format_Gradovi_2.readFeatures(json_Gradovi_2, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_Gradovi_2 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Gradovi_2.addFeatures(features_Gradovi_2);
var lyr_Gradovi_2 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_Gradovi_2, 
                style: style_Gradovi_2,
                interactive: true,
                title: '<img src="styles/legend/Gradovi_2.png" /> Gradovi'
            });

lyr_Hrvatska_0.setVisible(true);lyr_Parkovi_1.setVisible(true);lyr_Gradovi_2.setVisible(true);
var layersList = [lyr_Hrvatska_0,lyr_Parkovi_1,lyr_Gradovi_2];
lyr_Hrvatska_0.set('fieldAliases', {'id_0': 'id_0', 'iso': 'iso', 'name_0': 'name_0', 'id_1': 'id_1', 'name_1': 'name_1', 'hasc_1': 'hasc_1', 'ccn_1': 'ccn_1', 'cca_1': 'cca_1', 'type_1': 'type_1', 'engtype_1': 'engtype_1', 'nl_name_1': 'nl_name_1', 'varname_1': 'varname_1', });
lyr_Parkovi_1.set('fieldAliases', {'id': 'id', 'Park': 'Park', 'posjeta': 'posjeta', });
lyr_Gradovi_2.set('fieldAliases', {'id': 'id', 'grad': 'grad', 'posjeta': 'posjeta', });
lyr_Hrvatska_0.set('fieldImages', {'id_0': 'TextEdit', 'iso': 'TextEdit', 'name_0': 'TextEdit', 'id_1': 'TextEdit', 'name_1': 'TextEdit', 'hasc_1': 'TextEdit', 'ccn_1': 'TextEdit', 'cca_1': 'TextEdit', 'type_1': 'TextEdit', 'engtype_1': 'TextEdit', 'nl_name_1': 'TextEdit', 'varname_1': 'TextEdit', });
lyr_Parkovi_1.set('fieldImages', {'id': '', 'Park': '', 'posjeta': '', });
lyr_Gradovi_2.set('fieldImages', {'id': '', 'grad': '', 'posjeta': '', });
lyr_Hrvatska_0.set('fieldLabels', {'id_0': 'no label', 'iso': 'no label', 'name_0': 'no label', 'id_1': 'no label', 'name_1': 'no label', 'hasc_1': 'no label', 'ccn_1': 'no label', 'cca_1': 'no label', 'type_1': 'no label', 'engtype_1': 'no label', 'nl_name_1': 'no label', 'varname_1': 'no label', });
lyr_Parkovi_1.set('fieldLabels', {'id': 'no label', 'Park': 'no label', 'posjeta': 'no label', });
lyr_Gradovi_2.set('fieldLabels', {'id': 'no label', 'grad': 'no label', 'posjeta': 'no label', });
lyr_Gradovi_2.on('precompose', function(evt) {
    evt.context.globalCompositeOperation = 'normal';
});