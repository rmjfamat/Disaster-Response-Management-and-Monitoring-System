
package com.example.dswsapp00;

import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.PointF;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Filter;
import android.widget.Toast;

import com.google.gson.JsonElement;
import com.mapbox.geojson.Feature;
import com.mapbox.geojson.FeatureCollection;
import com.mapbox.mapboxsdk.Mapbox;
import com.mapbox.mapboxsdk.annotations.Marker;
import com.mapbox.mapboxsdk.annotations.MarkerOptions;
import com.mapbox.mapboxsdk.geometry.LatLng;
import com.mapbox.mapboxsdk.maps.MapView;
import com.mapbox.mapboxsdk.maps.MapboxMap;
import com.mapbox.mapboxsdk.maps.OnMapReadyCallback;
import com.mapbox.mapboxsdk.maps.Style;
import com.mapbox.mapboxsdk.style.expressions.Expression;
import com.mapbox.mapboxsdk.style.layers.FillLayer;
import com.mapbox.mapboxsdk.style.layers.PropertyFactory;
import com.mapbox.mapboxsdk.style.sources.GeoJsonSource;
import com.mapbox.mapboxsdk.style.sources.VectorSource;

import java.util.List;
import java.util.Map;


/**
 * Add a vector source to a map.
 */
public class Gdata extends AppCompatActivity implements OnMapReadyCallback, MapboxMap.OnMapClickListener{

    private MapView mapView;
    private Marker featureMarker;
    private MapboxMap mapboxMap;
    private String tablenameHolder = "";
    private String accessToken = "";
    private String mapID = "";
    private String layer = "";
    AlertDialog alertDialog1;
    Button searchBtn;
    EditText searchTxt;
    String searchName = "";
    VectorSource vc;
    GeoJsonSource jc;
    //sk.eyJ1Ijoicm1qZmFtYXQiLCJhIjoiY2p2M2ZtdzhzMDR6NzN5bWl0c2JrbGxvZyJ9.31-Y_o3jnJmP-pAluR9fGQ
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Mapbox.getInstance(this, getString(R.string.access_token));
        setContentView(R.layout.activity_gdata);

        Bundle b = getIntent().getExtras();
        tablenameHolder = b.getString("tablename");
        accessToken = b.getString("accesstoken");
        mapID = b.getString("mapid");
        layer = b.getString("layername");

        mapView = findViewById(R.id.mapView);
        mapView.onCreate(savedInstanceState);
        mapView.getMapAsync(this);

        searchBtn = findViewById(R.id.searchBtn);
        searchTxt = findViewById(R.id.search);

    }
    @Override
    public void onMapReady(@NonNull final MapboxMap mapboxMap) {
        Gdata.this.mapboxMap = mapboxMap;
        vc = new VectorSource("basak-data", "http://api.mapbox.com/v4/" + mapID.trim() + ".json?access_token=" + getString(R.string.access_token));
        mapboxMap.setStyle(Style.SATELLITE, new Style.OnStyleLoaded() {
            @Override
            public void onStyleLoaded(@NonNull Style style) {
                style.addSource(vc);
                
                final String[] str = {"basak-data"};
                FillLayer basak_data_fill = new FillLayer("basak-data", "basak-data");
                basak_data_fill.setSourceLayer(layer);
                basak_data_fill.setProperties(
                        PropertyFactory.fillOutlineColor(Color.parseColor("#ff69b4")),
                        PropertyFactory.fillColor(Color.parseColor("#3BFF69B4"))
                );

                style.addLayer(basak_data_fill);
                searchBtn.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        searchName = searchTxt.getText().toString().trim();

                    }
                });
                mapboxMap.addOnMapClickListener(Gdata.this);
                Toast.makeText(Gdata.this,
                        getString(R.string.click_on_map_instruction), Toast.LENGTH_SHORT).show();
            }
        });


    }


    @Override
    public boolean onMapClick(@NonNull LatLng point) {

        PointF pixel = mapboxMap.getProjection().toScreenLocation(point);
        List<Feature> features = mapboxMap.queryRenderedFeatures(pixel);
        if (features.size() > 0) {
            Feature feature = features.get(0);

            final StringBuilder stringBuilder = new StringBuilder();
            if (feature.properties() != null) {
                for (Map.Entry<String, JsonElement> entry : feature.properties().entrySet()) {
                    stringBuilder.append(String.format("%s - %s", entry.getKey(), entry.getValue()));
                    stringBuilder.append(System.getProperty("line.separator"));
                }

                featureMarker = mapboxMap.addMarker(new MarkerOptions()
                        .position(point)
                        .title(getString(R.string.query_feature_marker_title))
                        .snippet(stringBuilder.toString())
                );

                AlertDialog.Builder builder = new AlertDialog.Builder(this);
                //builder.setTitle("Scan Result\n\n" + result.getText() + "\n\nChoose type of assistance:");
                builder.setTitle("Properties");
                builder.setCancelable(false);
                builder.setMessage(stringBuilder.toString());

                builder.setPositiveButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        alertDialog1.cancel();
                    }
                });
                builder.setNeutralButton("Register", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        String output = stringBuilder.toString();
                        String outputs[] =output.split("\n");
                        String name = "";
                        boolean first_sym = false;
                        boolean second_sym = false;
                        int min = 0, max = 0;

                        for(int i = 0; i < outputs[0].length(); i++){
                            if(outputs[0].charAt(i) == '"'){
                                if(first_sym == false){
                                    first_sym = true;
                                    min = i + 1;
                                }else{
                                    second_sym = true;
                                    max = i;
                                }
                            }
                            if(first_sym == true && second_sym == true){
                                name = outputs[0].substring(min, max);
                                break;
                            }
                        }
                        String[] strArray = name.split(" ");
                        StringBuilder builder = new StringBuilder();
                        for (String s : strArray) {
                            String cap = s.substring(0, 1).toUpperCase() + s.substring(1);
                            builder.append(cap + " ");
                        }
                        name = builder.toString();

                        Intent reg = new Intent (Gdata.this, Register2.class);
                        reg.putExtra("tablename", tablenameHolder);
                        reg.putExtra("name", name);
                        reg.putExtra("verified", 1);
                        startActivity(reg);
                    }
                });
                alertDialog1 = builder.create();
                alertDialog1.show();


            } else {
                featureMarker = mapboxMap.addMarker(new MarkerOptions()
                        .position(point)
                        .snippet("No feature property found.")
                );
            }
        } else {
            featureMarker = mapboxMap.addMarker(new MarkerOptions()
                    .position(point)
                    .snippet("No feature property found.")
            );
        }
        mapboxMap.selectMarker(featureMarker);
        return true;
    }


    @Override
    public void onResume() {
        super.onResume();
        mapView.onResume();
    }

    @Override
    protected void onStart() {
        super.onStart();
        mapView.onStart();
    }

    @Override
    protected void onStop() {
        super.onStop();
        mapView.onStop();
    }

    @Override
    public void onPause() {
        super.onPause();
        mapView.onPause();
    }

    @Override
    public void onLowMemory() {
        super.onLowMemory();
        mapView.onLowMemory();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        mapView.onDestroy();
    }

    @Override
    protected void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);
        mapView.onSaveInstanceState(outState);
    }


}