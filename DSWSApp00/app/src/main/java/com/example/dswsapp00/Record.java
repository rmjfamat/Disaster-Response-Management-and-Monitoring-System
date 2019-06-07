package com.example.dswsapp00;

public class Record {
    private String codename;
    private String date;
    private String time;
    private String address;
    private String token;
    private String mapId;
    private String layer;

    public Record(String codename, String date, String time, String province, String municipal, String baranggay, String sitio, String token, String mapId, String layer) {
        this.codename = codename;
        this.date = date;
        this.time = time;
        this.address = sitio + ", " + baranggay + ", " + municipal + ", " + province;
        this.token = token;
        this.mapId = mapId;
        this.layer = layer;
    }

    public String getCodename() {
        return codename;
    }

    public String getDate() {
        return date;
    }

    public String getTime() {
        return time;
    }

    public String getAddress() {
        return address;
    }

    public String getAccessToken() {
        return token;
    }

    public String getMapId() {
        return mapId;
    }

    public String getLayer() {
        return layer;
    }

}
