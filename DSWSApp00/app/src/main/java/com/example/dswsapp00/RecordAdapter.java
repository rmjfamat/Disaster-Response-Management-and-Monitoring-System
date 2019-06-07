package com.example.dswsapp00;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.List;

public class RecordAdapter extends RecyclerView.Adapter<RecordAdapter.ViewHolder> {

    private List<Record>list_data;
    private LinearLayout layout;
    private String tablename;
    private String incident_address;
    private String tokenStr;
    private String mapIdStr;
    private String layerStr;

    public RecordAdapter(List<Record> list_data) {
        this.list_data = list_data;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view= LayoutInflater.from(parent.getContext()).inflate(R.layout.record_list,parent,false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        Record listData = list_data.get(position);
        holder.codename.setText(listData.getCodename());
        holder.date.setText(listData.getDate());
        holder.time.setText(listData.getTime());
        holder.address.setText(listData.getAddress());
        holder.accesstoken.setText(listData.getAccessToken());
        holder.mapid.setText(listData.getMapId());
        holder.layername.setText(listData.getLayer());

    }

    @Override
    public int getItemCount() {
        return list_data.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{

        private TextView codename, date, time, address, accesstoken, mapid, layername;

        public ViewHolder(final View itemView) {
            super(itemView);

            codename = itemView.findViewById(R.id.codename);
            date = itemView.findViewById(R.id.date);
            time = itemView.findViewById(R.id.time);
            address = itemView.findViewById(R.id.address);
            accesstoken = itemView.findViewById(R.id.accesstoken);
            mapid = itemView.findViewById(R.id.mapid);
            layername = itemView.findViewById(R.id.layername);

            layout = itemView.findViewById(R.id.goUpdate);

            layout.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(v.getContext(), Update.class);
                    TextView tn = itemView.findViewById(R.id.codename);
                    TextView fa = itemView.findViewById(R.id.address);
                    TextView as = itemView.findViewById(R.id.accesstoken);
                    TextView mi = itemView.findViewById(R.id.mapid);
                    TextView sn = itemView.findViewById(R.id.layername);
                    tablename = tn.getText().toString();
                    incident_address = fa.getText().toString();
                    tokenStr = as.getText().toString();
                    mapIdStr = mi.getText().toString();
                    layerStr = sn.getText().toString();

                    Bundle b = new Bundle();
                    b.putString("tablename", tablename);
                    b.putString("address", incident_address);
                    b.putString("accesstoken", tokenStr);
                    b.putString("mapid", mapIdStr);
                    b.putString("layername", layerStr);
                    intent.putExtras(b);
                    v.getContext().startActivity(intent);
                }
            });
        }
    }
}
