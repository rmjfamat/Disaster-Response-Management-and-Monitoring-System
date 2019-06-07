package com.example.dswsapp00;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.hardware.Camera;
import android.os.Build;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.zxing.Result;

import java.util.HashMap;
import java.util.Map;

import me.dm7.barcodescanner.zxing.ZXingScannerView;

import static android.Manifest.permission.CAMERA;

public class Scanner extends AppCompatActivity implements ZXingScannerView.ResultHandler {

    private static final int REQUEST_CAMERA = 1;
    private ZXingScannerView scannerView;
    private static int camId = Camera.CameraInfo.CAMERA_FACING_BACK;
    private static final String KEY_EMPTY = "";
    private static final String KEY_TABLE_NAME = "table_name";
    private static final String KEY_fNAME = "firstname";
    private static final String KEY_mNAME = "middlename";
    private static final String KEY_lNAME = "lastname";
    private static final String KEY_ASSISTANT_TYPE = "assistant_type";

    IPUrl ipUrl = new IPUrl();
    String ip = ipUrl.getIpadress();
    private String HttpUrl = "http://" + ip + "/dswsapp/update.php";

    String tablenameHolder, assistantTypeHolder = "", idHolder, firstname, middle, last;

    ProgressDialog pDialog;

    AlertDialog alertDialog1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        Bundle b = getIntent().getExtras();
        tablenameHolder = b.getString("tablename");
        assistantTypeHolder = b.getString("type");

        scannerView = new ZXingScannerView(this);
        setContentView(scannerView);
        int currentApiVersion = Build.VERSION.SDK_INT;

        if(currentApiVersion >=  Build.VERSION_CODES.M)
        {
            if(checkPermission())
            {
                Toast.makeText(getApplicationContext(), "Permission already granted!", Toast.LENGTH_LONG).show();
            }
            else
            {
                requestPermission();
            }
        }
    }

    private boolean checkPermission()
    {
        return (ContextCompat.checkSelfPermission(getApplicationContext(), CAMERA) == PackageManager.PERMISSION_GRANTED);
    }

    private void requestPermission()
    {
        ActivityCompat.requestPermissions(this, new String[]{CAMERA}, REQUEST_CAMERA);
    }

    @Override
    public void onResume() {
        super.onResume();

        int currentapiVersion = android.os.Build.VERSION.SDK_INT;
        if (currentapiVersion >= android.os.Build.VERSION_CODES.M) {
            if (checkPermission()) {
                if(scannerView == null) {
                    scannerView = new ZXingScannerView(this);
                    setContentView(scannerView);
                }
                scannerView.setResultHandler(this);
                scannerView.startCamera();
            } else {
                requestPermission();
            }
        }
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        scannerView.stopCamera();
    }

    public void onRequestPermissionsResult(int requestCode, String permissions[], int[] grantResults) {
        switch (requestCode) {
            case REQUEST_CAMERA:
                if (grantResults.length > 0) {

                    boolean cameraAccepted = grantResults[0] == PackageManager.PERMISSION_GRANTED;
                    if (cameraAccepted){
                        Toast.makeText(getApplicationContext(), "Permission Granted, Now you can access camera", Toast.LENGTH_LONG).show();
                    }else {
                        Toast.makeText(getApplicationContext(), "Permission Denied, You cannot access and camera", Toast.LENGTH_LONG).show();
                        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                            if (shouldShowRequestPermissionRationale(CAMERA)) {
                                showMessageOKCancel("You need to allow access to both the permissions",
                                        new DialogInterface.OnClickListener() {
                                            @Override
                                            public void onClick(DialogInterface dialog, int which) {
                                                if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                                                    requestPermissions(new String[]{CAMERA},
                                                            REQUEST_CAMERA);
                                                }
                                            }
                                        });
                                return;
                            }
                        }
                    }
                }
                break;
        }
    }

    private void showMessageOKCancel(String message, DialogInterface.OnClickListener okListener) {
        new android.support.v7.app.AlertDialog.Builder(Scanner.this)
                .setMessage(message)
                .setPositiveButton("OK", okListener)
                .setNegativeButton("Cancel", null)
                .create()
                .show();
    }

    @Override
    public void handleResult(Result result) {
        Log.d("QRCodeScanner", result.getText());
        Log.d("QRCodeScanner", result.getBarcodeFormat().toString());
        //Use this code
        TextView title = new TextView(this);
        title.setText("SCAN RESULT\n\n" + result.getText());
        title.setTextSize(19);
        title.setTextColor(Color.BLACK);
        title.setPadding(40, 40, 10, 10);

        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        //builder.setTitle("Scan Result\n\n" + result.getText() + "\n\nChoose type of assistance:");
        builder.setCustomTitle(title);
        //builder.setMessage(result.getText());
        idHolder = result.getText();
        String[] split = idHolder.split(" ");
        firstname = split[0];
        middle = split[1];
        last = split[2];

        builder.setPositiveButton("Cancel", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                scannerView.resumeCameraPreview(Scanner.this);
            }
        });
        builder.setNeutralButton("Update", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                if(assistantTypeHolder.equals(KEY_EMPTY)){
                    AlertDialog.Builder builder1 = new AlertDialog.Builder(Scanner.this);
                    builder1.setTitle("Action Response:");
                    builder1.setMessage("Update failed. Please choose the type of assistance.");
                    builder1.setPositiveButton("Try again.", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            scannerView.resumeCameraPreview(Scanner.this);
                        }
                    });
                    AlertDialog alert11 = builder1.create();
                    alert11.show();
                }else{
                    updateData();
                }
            }
        });

        alertDialog1 = builder.create();
        alertDialog1.show();
        alertDialog1.getWindow().setLayout(650, 400); //Controlling width and height.
    }

    private void updateData(){
        displayLoader();
        StringRequest stringRequest = new StringRequest(Request.Method.POST, HttpUrl,
                new com.android.volley.Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {

                        // Hiding the progress dialog after all task complete.
                        pDialog.dismiss();

                        // Showing response message coming from server.
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Scanner.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(ServerResponse);
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                scannerView.resumeCameraPreview(Scanner.this);
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
                        //Toast.makeText(Register.this, volleyError.toString(), Toast.LENGTH_LONG).show();
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Scanner.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(volleyError.toString());
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back to Home", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                startActivity(new Intent(Scanner.this,Home.class));
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
                params.put(KEY_TABLE_NAME, tablenameHolder);
                params.put(KEY_fNAME, firstname);
                params.put(KEY_lNAME, last);
                params.put(KEY_mNAME, middle);
                params.put(KEY_ASSISTANT_TYPE, assistantTypeHolder);

                return params;
            }

        };

        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(Scanner.this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest);

    }

    private void displayLoader() {
        pDialog = new ProgressDialog(Scanner.this);
        pDialog.setMessage("Please Wait, We are Updating Your Data on Server");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();

    }
}
