package com.example.dswsapp00;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class Home extends AppCompatActivity {
    private SessionHandler session;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.fragment_home);
        session = new SessionHandler(getApplicationContext());

        Button update_btn = findViewById(R.id.update);
        Button create_btn = findViewById(R.id.create);
        TextView out = findViewById(R.id.logout);

        update_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(v.getContext(), ExistingData.class);
                v.getContext().startActivity(intent);
            }
        });

        create_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(v.getContext(), Create.class);
                v.getContext().startActivity(intent);
            }
        });


        out.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                session.logoutUser();
                Intent i = new Intent(Home.this, Login.class);
                startActivity(i);
                finish();

            }
        });
    }


}