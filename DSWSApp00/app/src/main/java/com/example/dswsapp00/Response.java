package com.example.dswsapp00;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class Response extends AppCompatActivity {
    private String rs;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_response);

        Bundle b = getIntent().getExtras();
        rs = b.getString("response");
        TextView res = findViewById(R.id.response);
        res.setText(rs);
    }
}
