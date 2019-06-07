package com.example.dswsapp00;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class Update extends AppCompatActivity {
    String tablename00 = "";
    String address00 = "";
    String accessToken = "";
    String mapID = "";
    String layer = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update);

        Bundle b = getIntent().getExtras();
        tablename00 = b.getString("tablename");
        address00 = b.getString("address");
        accessToken = b.getString("accesstoken");
        mapID = b.getString("mapid");
        layer = b.getString("layername");

        TextView table, adr;
        table = findViewById(R.id.tablename);
        adr = findViewById(R.id.address);
        table.setText(tablename00);
        adr.setText(address00);
    }

    public void gisData(View view){
        Intent viewData = new Intent (this, Gdata.class);
        viewData.putExtra("tablename", tablename00);
        viewData.putExtra("accesstoken", accessToken);
        viewData.putExtra("mapid", mapID);
        viewData.putExtra("layername", layer);
        startActivity(viewData);
    }

    public void scanCode(View view){
        Intent scan  = new Intent (this, Assistances.class);
        scan.putExtra("tablename", tablename00);
        startActivity(scan);
    }

    public void register(View view){
        Intent reg = new Intent (this, Register2.class);
        reg.putExtra("tablename", tablename00);
        reg.putExtra("name", "");
        reg.putExtra("verified", -1);
        startActivity(reg);
    }
}
