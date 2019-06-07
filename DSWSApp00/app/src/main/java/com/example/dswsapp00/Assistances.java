package com.example.dswsapp00;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class Assistances extends AppCompatActivity {
    String tablename00;
    int size = 0;
    Button assistance1;
    Button assistance2;
    Button assistance3;
    Button assistance4;
    Button assistance5;
    Button assistance6;
    Button assistance7;
    Button addNew;

    IPUrl ipUrl = new IPUrl();
    String ip = ipUrl.getIpadress();
    private String HttpUrlSize = "http://" + ip + "/dswsapp/getSize.php";
    private String HttpUrl = "http://" + ip + "/dswsapp/update.php";
    private static final String KEY_TABLE_NAME = "table_name";
    private static final String KEY_SIZE = "size";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_assistances);

        Bundle b = getIntent().getExtras();
        tablename00 = b.getString("tablename");

    }

    public void foodpacks(View view){
        Intent viewData = new Intent (this, Scanner.class);
        viewData.putExtra("tablename", tablename00);
        viewData.putExtra("type", "assistance1");
        startActivity(viewData);
    }


    public void reliefpacks(View view){
        Intent viewData = new Intent (this, Scanner.class);
        viewData.putExtra("tablename", tablename00);
        viewData.putExtra("type", "assistance2");
        startActivity(viewData);
    }

    public void healthkits(View view){
        Intent viewData = new Intent (this, Scanner.class);
        viewData.putExtra("tablename", tablename00);
        viewData.putExtra("type", "assistance3");
        startActivity(viewData);
    }

    public void housing(View view){
        Intent viewData = new Intent (this, Scanner.class);
        viewData.putExtra("tablename", tablename00);
        viewData.putExtra("type", "assistance4");
        startActivity(viewData);
    }

    public void financial(View view){
        Intent viewData = new Intent (this, Scanner.class);
        viewData.putExtra("tablename", tablename00);
        viewData.putExtra("type", "assistance5");
        startActivity(viewData);
    }



}
