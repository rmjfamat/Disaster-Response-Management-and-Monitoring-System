package com.example.dswsapp00;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ExistingData extends AppCompatActivity {

    IPUrl ipUrl = new IPUrl();
    String ip = ipUrl.getIpadress();
    private String HttpUrl = "http://" +  ip + "/dswsapp/getRecord.php";
    private List<Record>list_data;
    private RecyclerView rv;
    private RecordAdapter adapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_existing_data);
        rv = findViewById(R.id.recyclerView);
        rv.setHasFixedSize(true);
        rv.setLayoutManager(new LinearLayoutManager(this));
        list_data=new ArrayList<>();
        adapter=new RecordAdapter(list_data);

        getFireData();

    }

    private void getFireData() {
        StringRequest stringRequest=new StringRequest(Request.Method.GET, HttpUrl, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject=new JSONObject(response);
                    JSONArray array=jsonObject.getJSONArray("data");
                    for (int i=0; i<array.length(); i++ ){
                        JSONObject ob=array.getJSONObject(i);
                        Record listData = new Record(ob.getString("codeName") ,ob.getString("Date"), ob.getString("Time"), ob.getString("Province"), ob.getString("Municipality"), ob.getString("Baranggay"), ob.getString("Sitio"), ob.getString("accessToken"), ob.getString("mapID"), ob.getString("sourceLayerName"));
                        list_data.add(listData);
                    }

                    rv.setAdapter(adapter);
                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        });
        RequestQueue requestQueue= Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
