package com.example.dswsapp00;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;


public class Create extends AppCompatActivity {
    private static final String KEY_CODENAME = "codeName";
    private static final String KEY_DATE = "Date";
    private static final String KEY_TIME = "Time";
    private static final String KEY_REGION = "Region";
    private static final String KEY_PROVINCE = "Province";
    private static final String KEY_MUNICIPALITY = "Municipality";
    private static final String KEY_BARANGGAY = "Baranggay";
    private static final String KEY_SITIO = "Sitio";
    private static final String KEY_ACCESS_TOKEN = "accessToken";
    private static final String KEY_MAP_ID = "mapID";
    private static final String KEY_SOURCELAYER_NAME = "sourceLayerName";
    private static final String KEY_EMPTY = "";

    IPUrl ipUrl = new IPUrl();
    String ip = ipUrl.getIpadress();
    private String HttpUrl = "http://" + ip + "/dswsapp/newtable.php";

    EditText codename, date, time, region, province, municipality, baranggay, sitio, accesstoken, mapid, sourcelayername;
    Button create;
    ProgressDialog pDialog;
    RequestQueue requestQueue;
    String codenameHolder, dateHolder, timeHolder, regionHolder, provinceHolder, municipalHolder, barangayHolder, sitioHolder, accessTokenHolder, mapIdHolder, sourceLayernameHolder;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_create);

        codename = findViewById(R.id.codename);
        date = findViewById(R.id.date);
        time = findViewById(R.id.time);
        region = findViewById(R.id.region);
        province = findViewById(R.id.province);
        municipality = findViewById(R.id.municipal);
        baranggay = findViewById(R.id.barangay);
        sitio = findViewById(R.id.sitio);
        accesstoken = findViewById(R.id.accesstoken);
        accesstoken.setText("sk.eyJ1Ijoicm1qZmFtYXQiLCJhIjoiY2p2M2ZtdzhzMDR6NzN5bWl0c2JrbGxvZyJ9.31-Y_o3jnJmP-pAluR9fGQ");
        mapid = findViewById(R.id.mapID);
        sourcelayername = findViewById(R.id.sourceLayer);
        create = findViewById(R.id.btnCreate);

        requestQueue = Volley.newRequestQueue(Create.this);

        create.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                GetValueFromEditText();
                if(validateInputs()){
                    createnewData();
                }
            }
        });

    }

    //create new data
    public void createnewData(){
        displayLoader();
        StringRequest stringRequest = new StringRequest(Request.Method.POST, HttpUrl,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {

                        // Hiding the progress dialog after all task complete.
                        pDialog.dismiss();

                        // Showing response message coming from server.
                       // Toast.makeText(Create.this, ServerResponse, Toast.LENGTH_LONG).show();
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Create.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(ServerResponse);
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back to Home", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                startActivity(new Intent(Create.this,Home.class));
                            }
                        });
                        AlertDialog alert11 = builder1.create();
                        alert11.show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {

                        // Hiding the progress dialog after all task complete.
                        pDialog.dismiss();

                        // Showing error message if something goes wrong.
                        //Toast.makeText(Create.this, volleyError.toString(), Toast.LENGTH_LONG).show();
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Create.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(volleyError.toString());
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back to Home", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                startActivity(new Intent(Create.this,Home.class));
                            }
                        });
                        AlertDialog alert11 = builder1.create();
                        alert11.show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() {

                // Creating Map String Params.
                Map<String, String> params = new HashMap<String, String>();

                // Adding All values to Params.
                params.put(KEY_CODENAME, codenameHolder);
                params.put(KEY_DATE, dateHolder);
                params.put(KEY_TIME, timeHolder);
                params.put(KEY_REGION, regionHolder);
                params.put(KEY_PROVINCE, provinceHolder);
                params.put(KEY_MUNICIPALITY, municipalHolder);
                params.put(KEY_BARANGGAY, barangayHolder);
                params.put(KEY_SITIO, sitioHolder);
                params.put(KEY_ACCESS_TOKEN, accessTokenHolder);
                params.put(KEY_MAP_ID, mapIdHolder);
                params.put(KEY_SOURCELAYER_NAME, sourceLayernameHolder);

                return params;
            }

        };

        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(Create.this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest);
    }

    private boolean validateInputs() {
        if (KEY_EMPTY.equals(codenameHolder)) {
            codename.setError("Cannot be empty");
            codename.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(dateHolder)) {
            date.setError("Cannot be empty");
            date.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(timeHolder)) {
            time.setError("Cannot be empty");
            time.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(regionHolder)) {
            region.setError("Cannot be empty");
            region.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(provinceHolder)) {
            province.setError("Cannot be empty");
            province.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(municipalHolder)) {
            municipality.setError("Cannot be empty");
            municipality.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(barangayHolder)) {
            baranggay.setError("Cannot be empty");
            baranggay.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(sitioHolder)) {
            sitio.setError("Cannot be empty");
            sitio.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(sitioHolder)) {
            sitio.setError("Cannot be empty");
            sitio.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(accessTokenHolder)) {
            accesstoken.setError("Cannot be empty");
            accesstoken.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(mapIdHolder)) {
            mapid.setError("Cannot be empty");
            mapid.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(sourceLayernameHolder)) {
            sourcelayername.setError("Cannot be empty");
            sourcelayername.requestFocus();
            return false;
        }


        return true;
    }

    private void displayLoader() {
        pDialog = new ProgressDialog(Create.this);
        pDialog.setMessage("Please Wait, We are creating Your Data on Server");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();

    }

    public void GetValueFromEditText() {
        codenameHolder = codename.getText().toString().trim();
        dateHolder = date.getText().toString().trim();
        timeHolder = time.getText().toString().trim();
        regionHolder = region.getText().toString().trim();
        provinceHolder = province.getText().toString().trim();
        municipalHolder = municipality.getText().toString().trim();
        barangayHolder = baranggay.getText().toString().trim();
        sitioHolder = sitio.getText().toString().trim();
        accessTokenHolder = accesstoken.getText().toString().trim();
        mapIdHolder = mapid.getText().toString().trim();
        sourceLayernameHolder = sourcelayername.getText().toString().trim();

    }

}
