package com.example.dswsapp00;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.CheckBox;
import android.widget.FrameLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;
import android.widget.EditText;
import android.widget.Button;
import java.util.HashMap;
import java.util.Map;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class Register extends AppCompatActivity {
    private static final String KEY_FULLNAME = "name";
    private static final String KEY_AGE = "head_age";
    private static final String KEY_OCCUPATION = "occupation";
    private static final String KEY_HEAD_GENDER = "headGender";
    private static final String KEY_HEAD_BIRTHDATE = "headBirthdate";
    private static final String KEY_INCOME = "income";
    private static final String HOUSE_CASE = "houseCase";
    private static final String KEY_HOUSE_CONDITION = "houseCondition";
    private static final String KEY_VICTIM_CODE = "victimCode";
    private static final String KEY_HEALTH = "healthCondition";
    private static final String KEY_ETHNICITY = "ethnicity";
    private static final String FOUR_PS = "FPSMember";
    private static final String MEMBER_ONE = "familyMember_1";
    private static final String MEMBER_TWO = "familyMember_2";
    private static final String MEMBER_THREE = "familyMember_3";
    private static final String KEY_EMPTY = "";
    private static final String KEY_TABLE_NAME = "table_name";
    private static final String KEY_VERIFY = "verified";

    IPUrl ipUrl = new IPUrl();
    String ip = ipUrl.getIpadress();
    private String HttpUrl = "http://" + ip + "/dswsapp/insertdata.php";
    String passedName = "";

    EditText fullname, head_age, occupation, birthdate, head_income, ethnicity;
    RadioGroup head_sex, house_case, house_condition, victim_code, health_condition;
    RadioButton head_sex_checked, house_case_checked, house_con_checked, victim_code_checked, health_con_checked;
    RadioButton head_f, house_f, member1_f, member2_f, member3_f, member4_f, partial_f, code_f, health_f;

    //members
    EditText name1, age1, relation1, education1, skills1, remarks1;
    EditText name2, age2, relation2, education2, skills2, remarks2;
    EditText name3, age3, relation3, education3, skills3, remarks3;
    EditText name4, age4, relation4, education4, skills4, remarks4;
    RadioGroup memberGroup1, memberGroup2, memberGroup3, memberGroup4;
    RadioButton memberGroup1_checked, memberGroup2_checked, memberGroup3_checked, memberGroup4_checked;
    int selectedId, selectedId_houseCase, selected_id_member1, selected_id_member2, selected_id_member3, selected_id_member4, selectedId_houseCon, selectedIdVictimCode, selectedIdHealthCon;

    CheckBox four_ps, verify;
    Button InsertButton, addMember;
    String FullNameHolder, HeadAgeHolder, OccupationHolder, HeadGenderHolder, BirthdateHolder, HeadIncomeHolder, HouseCaseHolder, HouseConditionHolder, VictimCodeHolder, HealthConHolder, EthnicityHolder, FourPsHolder, VerifyHolder;

    //members string holder
    String nameHolder1, ageHolder1, genderHolder1, relationHolder1, educationHolder1, skills1Holder1, remarksHolder1, tablenameHolder, MemberHolder1;
    String nameHolder2, ageHolder2, genderHolder2, relationHolder2, educationHolder2, skills1Holder2, remarksHolder2, MemberHolder2;
    String nameHolder3, ageHolder3, genderHolder3, relationHolder3, educationHolder3, skills1Holder3, remarksHolder3, MemberHolder3;

    ProgressDialog pDialog;
    RequestQueue requestQueue;
    int memberCount = 1;
    int ver;
    boolean successAdding1 = false, successAdding2 = false, successAdding3 = false, successAdding4 = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        Bundle b = getIntent().getExtras();
        tablenameHolder = b.getString("tablename");
        passedName = b.getString("name");
        ver = b.getInt("verified");

        //family head details
        fullname = findViewById(R.id.firstname);
        fullname.setText(passedName);
        head_age = findViewById(R.id.head_age);
        occupation = findViewById(R.id.occupation_input);
        birthdate = findViewById(R.id.bday_date);
        head_income = findViewById(R.id.income_input);
        ethnicity = findViewById(R.id.ethnicity);
        four_ps = findViewById(R.id.fourps);
        verify = findViewById(R.id.verif);

        if(ver == 1){
            verify.setChecked(true);
        }else{
            verify.setChecked(false);
        }

        addMember = findViewById(R.id.addFamily);
        InsertButton = findViewById(R.id.insert_btn);
        requestQueue = Volley.newRequestQueue(Register.this);

        //member 1
        name1 = findViewById(R.id.member_name1);
        age1 = findViewById(R.id.member_age1);
        education1 = findViewById(R.id.member_education1);
        skills1 = findViewById(R.id.member_skills1);
        remarks1 = findViewById(R.id.member_remarks1);
        relation1 = findViewById(R.id.member_relation1);

        //member 2
        name2 = findViewById(R.id.name2);
        age2 = findViewById(R.id.age2);
        education2 = findViewById(R.id.education2);
        skills2 = findViewById(R.id.skills2);
        remarks2 = findViewById(R.id.remarks2);
        relation2 = findViewById(R.id.relation2);

        //member 3
        name3 = findViewById(R.id.name3);
        age3 = findViewById(R.id.age3);
        education3 = findViewById(R.id.education3);
        skills3 = findViewById(R.id.skills3);
        remarks3 = findViewById(R.id.remarks3);
        relation3 = findViewById(R.id.relation3);


        addMember.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                memberCount++;
                if(memberCount < 4)
                    addMemberFrame(memberCount);
                else{
                    memberCount--;
                    Toast.makeText(getApplicationContext(), "Can enter only upto 4 members", Toast.LENGTH_LONG).show();
                }
            }
        });



        InsertButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //family head sex radio button
                head_sex = findViewById(R.id.radioGroupHead);
                selectedId = head_sex.getCheckedRadioButtonId();
                head_f = findViewById(R.id.head_female);

                house_case = findViewById(R.id.houseCase);
                selectedId_houseCase = house_case.getCheckedRadioButtonId();
                house_f = findViewById(R.id.owner);

                house_condition = findViewById(R.id.radio_house_condition);
                selectedId_houseCon = house_condition.getCheckedRadioButtonId();
                partial_f = findViewById(R.id.partially);

                victim_code = findViewById(R.id.victimCode);
                selectedIdVictimCode = victim_code.getCheckedRadioButtonId();
                code_f = findViewById(R.id.codeA);

                health_condition = findViewById(R.id.healthCode);
                selectedIdHealthCon = health_condition.getCheckedRadioButtonId();
                health_f = findViewById(R.id.health01);

                if(selectedId == -1){
                    HeadGenderHolder = KEY_EMPTY;
                }else{
                    head_sex_checked = findViewById(selectedId);
                    HeadGenderHolder = head_sex_checked.getText().toString().trim();
                }

                if(selectedId_houseCase == -1){
                    HouseCaseHolder = KEY_EMPTY;
                }else{
                    house_case_checked = findViewById(selectedId_houseCase);
                    HouseCaseHolder = house_case_checked.getText().toString().trim();
                }

                if(selectedId_houseCon == -1){
                    HouseConditionHolder = KEY_EMPTY;
                }else{
                    house_con_checked = findViewById(selectedId_houseCon);
                    HouseConditionHolder = house_con_checked.getText().toString().trim();
                }

                if(selectedIdVictimCode == -1){
                    VictimCodeHolder = KEY_EMPTY;
                }else{
                    victim_code_checked = findViewById(selectedIdVictimCode);
                    VictimCodeHolder = victim_code_checked.getText().toString().trim();
                }

                if(selectedIdHealthCon == -1){
                    HealthConHolder = KEY_EMPTY;
                }else{
                    health_con_checked = findViewById(selectedIdHealthCon);
                    HealthConHolder = health_con_checked.getText().toString().trim();
                }

                if(four_ps.isChecked()){
                    FourPsHolder = "Yes";
                }else{
                    FourPsHolder = "No";
                }

                if(verify.isChecked()){
                    VerifyHolder = "Yes";
                }else{
                    VerifyHolder = "No";
                }

                GetValueFromEditText();

                if(memberCount == 1){
                    //family member data 1
                    nameHolder1 = name1.getText().toString().trim();
                    ageHolder1 = age1.getText().toString().trim();
                    relationHolder1 = relation1.getText().toString().trim();
                    educationHolder1 = education1.getText().toString().trim();
                    skills1Holder1 = skills1.getText().toString().trim();
                    remarksHolder1 = remarks1.getText().toString().trim();

                    memberGroup1 = findViewById(R.id.radioAddmemberGender);
                    selected_id_member1  = memberGroup1.getCheckedRadioButtonId();
                    member1_f = findViewById(R.id.member_female1);
                    if(selected_id_member1 == -1){
                        genderHolder1 = KEY_EMPTY;
                    }else{
                        memberGroup1_checked = findViewById(selected_id_member1);
                        genderHolder1 = memberGroup1_checked.getText().toString().trim();
                    }

                    if(checkValidMember1())
                        successAdding1 = true;
                }
                if(memberCount == 2){
                    if(successAdding1){
                        //family member data 2
                        nameHolder2 = name2.getText().toString().trim();
                        ageHolder2 = age2.getText().toString().trim();
                        relationHolder2 = relation2.getText().toString().trim();
                        educationHolder2 = education2.getText().toString().trim();
                        skills1Holder2 = skills2.getText().toString().trim();
                        remarksHolder2 = remarks2.getText().toString().trim();

                        memberGroup2 = findViewById(R.id.radioAddmember2);
                        selected_id_member2  = memberGroup2.getCheckedRadioButtonId();
                        member2_f = findViewById(R.id.female22);
                        if(selected_id_member2 == -1){
                            genderHolder2= KEY_EMPTY;
                        }else{
                            memberGroup2_checked = findViewById(selected_id_member2);
                            genderHolder2 = memberGroup2_checked.getText().toString().trim();
                        }

                        if(checkValidMember2())
                            successAdding2 = true;

                    }else{
                        Toast.makeText(getApplicationContext(), "Please complete required information of member 1 first.", Toast.LENGTH_LONG).show();
                    }
                }
                if(memberCount == 3) {
                    if(successAdding2){
                        //family member data 3
                        nameHolder3 = name3.getText().toString().trim();
                        ageHolder3 = age3.getText().toString().trim();
                        relationHolder3 = relation3.getText().toString().trim();
                        educationHolder3 = education3.getText().toString().trim();
                        skills1Holder3 = skills3.getText().toString().trim();
                        remarksHolder3 = remarks3.getText().toString().trim();

                        memberGroup3 = findViewById(R.id.radioAddmember3);
                        selected_id_member3  = memberGroup3.getCheckedRadioButtonId();
                        member3_f = findViewById(R.id.female23);
                        if(selected_id_member3 == -1){
                            genderHolder3= KEY_EMPTY;
                        }else{
                            memberGroup3_checked = findViewById(selected_id_member3);
                            genderHolder3 = memberGroup3_checked.getText().toString().trim();
                        }

                        if(checkValidMember3())
                            successAdding3 = true;

                    }else{
                        Toast.makeText(getApplicationContext(), "Please complete required information of member 2 first.", Toast.LENGTH_LONG).show();
                    }
                }

                if(validateInputs()){
                    if(memberCount == 1){
                        if(successAdding1){
                            MemberHolder2 = "no family member";
                            MemberHolder3 = "no family member";
                            insertData();
                        }
                        else{
                            if(genderHolder1.equals(KEY_EMPTY)){
                                Toast.makeText(getApplicationContext(), "Select member sex.", Toast.LENGTH_LONG).show();
                            }
                        }
                    }
                    if(memberCount == 2){
                        if(successAdding1){
                            if(successAdding2){
                                MemberHolder3 = "no family member";
                                insertData();
                            }else{
                                Toast.makeText(getApplicationContext(), "Incomplete data in member 2", Toast.LENGTH_LONG).show();
                            }
                        }else{
                            Toast.makeText(getApplicationContext(), "Incomplete data in member 1", Toast.LENGTH_LONG).show();
                        }
                    }
                    if(memberCount == 3){
                        if(successAdding1){
                            if(successAdding2){
                                if(successAdding3){
                                    insertData();
                                }else{
                                    Toast.makeText(getApplicationContext(), "Incomplete data in member 3", Toast.LENGTH_LONG).show();
                                }
                            }else{
                                Toast.makeText(getApplicationContext(), "Incomplete data in member 2", Toast.LENGTH_LONG).show();
                            }
                        }else{
                            Toast.makeText(getApplicationContext(), "Incomplete data in member 1", Toast.LENGTH_LONG).show();
                        }
                    }
                }else {
                    if(HeadGenderHolder.equals(KEY_EMPTY)){
                        Toast.makeText(getApplicationContext(), "Select head sex.", Toast.LENGTH_LONG).show();
                    }else if(HouseCaseHolder.equals(KEY_EMPTY)){
                        Toast.makeText(getApplicationContext(), "Select house case.", Toast.LENGTH_LONG).show();
                    }else if(HouseConditionHolder.equals(KEY_EMPTY)){
                        Toast.makeText(getApplicationContext(), "Select house condition.", Toast.LENGTH_LONG).show();
                    }else if(VictimCodeHolder.equals(KEY_EMPTY)){
                        Toast.makeText(getApplicationContext(), "Select victim code.", Toast.LENGTH_LONG).show();
                    }else if(HealthConHolder.equals(KEY_EMPTY)){
                        Toast.makeText(getApplicationContext(), "Select health condition.", Toast.LENGTH_LONG).show();
                    }
                }
            }

        });
    }

    //insert data
    public void insertData(){
        displayLoader();
        StringRequest stringRequest = new StringRequest(Request.Method.POST, HttpUrl,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String ServerResponse) {

                        // Hiding the progress dialog after all task complete.
                        pDialog.dismiss();

                        // Showing response message coming from server.
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Register.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(ServerResponse);
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                startActivity(new Intent(Register.this, Update.class));
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
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Register.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(volleyError.toString());
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back to Home", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                startActivity(new Intent(Register.this,Home.class));
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
                params.put(KEY_FULLNAME, FullNameHolder);
                params.put(KEY_AGE, HeadAgeHolder);
                params.put(KEY_OCCUPATION, OccupationHolder);
                params.put(KEY_HEAD_GENDER, HeadGenderHolder);
                params.put(KEY_HEAD_BIRTHDATE, BirthdateHolder);
                params.put(KEY_INCOME, HeadIncomeHolder);
                params.put(HOUSE_CASE, HouseCaseHolder);
                params.put(KEY_HOUSE_CONDITION, HouseConditionHolder);
                params.put(KEY_VICTIM_CODE, VictimCodeHolder);
                params.put(KEY_HEALTH, HealthConHolder);
                params.put(KEY_ETHNICITY, EthnicityHolder);
                params.put(FOUR_PS, FourPsHolder);
                params.put(MEMBER_ONE, MemberHolder1);
                params.put(MEMBER_TWO, MemberHolder2);
                params.put(MEMBER_THREE, MemberHolder3);
                params.put(KEY_VERIFY, VerifyHolder);

                return params;
            }

        };

        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(Register.this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest);
    }

    private boolean validateInputs() {
        if (KEY_EMPTY.equals(FullNameHolder)) {
            fullname.setError("Cannot be empty");
            fullname.requestFocus();
            return false;
        }

        if(KEY_EMPTY.equals(HeadAgeHolder)){
            head_age.setError("Cannot be empty");
            head_age.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(HeadGenderHolder)) {
            head_f.setError("Cannot be empty");
            head_f.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(BirthdateHolder)) {
            birthdate.setError("Cannot be empty");
            birthdate.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(OccupationHolder)) {
            occupation.setError("Cannot be empty");
            occupation.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(HeadIncomeHolder)) {
            head_income.setError("Cannot be empty");
            head_income.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(EthnicityHolder)) {
            ethnicity.setError("Cannot be empty");
            ethnicity.requestFocus();
            return false;
        }
        if (KEY_EMPTY.equals(HouseCaseHolder)) {
            house_f.setError("Cannot be empty");
            house_f.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(HouseConditionHolder)) {
            partial_f.setError("Cannot be empty");
            partial_f.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(VictimCodeHolder)) {
            code_f.setError("Cannot be empty");
            code_f.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(HealthConHolder)) {
            health_f.setError("Cannot be empty");
            health_f.requestFocus();
            return false;
        }

        return true;
    }

            //show dialogue

    private void displayLoader() {
        pDialog = new ProgressDialog(Register.this);
        pDialog.setMessage("Please Wait, We are Inserting Your Data on Server");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();

    }

    //add member
    public void addMemberFrame(int count){
        if(count == (2)) {
            //family member data 1
            nameHolder1 = name1.getText().toString().trim();
            ageHolder1 = age1.getText().toString().trim();
            relationHolder1 = relation1.getText().toString().trim();
            educationHolder1 = education1.getText().toString().trim();
            skills1Holder1 = skills1.getText().toString().trim();
            remarksHolder1 = remarks1.getText().toString().trim();

            //member 1
            memberGroup1 = findViewById(R.id.radioAddmemberGender);
            selected_id_member1  = memberGroup1.getCheckedRadioButtonId();
            member1_f = findViewById(R.id.member_female1);
            if(selected_id_member1 == -1){
                genderHolder1 = KEY_EMPTY;
            }else{
                memberGroup1_checked = findViewById(selected_id_member1);
                genderHolder1 = memberGroup1_checked.getText().toString().trim();
            }

            if(checkValidMember1()){
                if(!(relationHolder1.equals(KEY_EMPTY) &&  genderHolder1.equals(KEY_EMPTY) && ageHolder1.equals(KEY_EMPTY)  && educationHolder1.equals(KEY_EMPTY) && skills1Holder1.equals(KEY_EMPTY) && remarksHolder1.equals(KEY_EMPTY))){
                    successAdding1 = true;
                }
            }

            if(successAdding1){
                FrameLayout addFrame = findViewById(R.id.addMembers2);
                addFrame.setVisibility(View.VISIBLE);
            }else{
                memberCount--;
                Toast.makeText(getApplicationContext(), "Please complete required information of member 1 first.", Toast.LENGTH_LONG).show();
            }

        }

        if(count == (3)) {
            if(successAdding1){
                //family member data 2
                nameHolder2 = name2.getText().toString().trim();
                ageHolder2 = age2.getText().toString().trim();
                relationHolder2 = relation2.getText().toString().trim();
                educationHolder2 = education2.getText().toString().trim();
                skills1Holder2 = skills2.getText().toString().trim();
                remarksHolder2 = remarks2.getText().toString().trim();

                //member 2
                memberGroup2 = findViewById(R.id.radioAddmember2);
                selected_id_member2  = memberGroup2.getCheckedRadioButtonId();
                member2_f = findViewById(R.id.female22);
                if(selected_id_member2 == -1){
                    genderHolder2 = KEY_EMPTY;
                }else{
                    memberGroup2_checked = findViewById(selected_id_member2);
                    genderHolder2 = memberGroup2_checked.getText().toString().trim();
                }

                if(checkValidMember2()){
                    if(!(relationHolder2.equals(KEY_EMPTY) &&  genderHolder2.equals(KEY_EMPTY) && ageHolder2.equals(KEY_EMPTY)  && educationHolder2.equals(KEY_EMPTY) && skills1Holder2.equals(KEY_EMPTY) && remarksHolder2.equals(KEY_EMPTY))){
                        successAdding2 = true;
                    }
                }

                if(successAdding2){
                    FrameLayout addFrame = findViewById(R.id.addMembers3);
                    addFrame.setVisibility(View.VISIBLE);
                }else{
                    memberCount--;
                    Toast.makeText(getApplicationContext(), "Please complete required information of member 2 first.", Toast.LENGTH_LONG).show();
                }
            }else{
                memberCount--;
                Toast.makeText(getApplicationContext(), "Please complete required information of member 1 first.", Toast.LENGTH_LONG).show();
            }

        }

    }


    //creating method to get value fro EditText
    public void GetValueFromEditText(){
        FullNameHolder = fullname.getText().toString().trim();
        HeadAgeHolder = head_age.getText().toString().trim();
        OccupationHolder = occupation.getText().toString().trim();
        BirthdateHolder = birthdate.getText().toString().trim();
        HeadIncomeHolder = head_income.getText().toString().trim();
        EthnicityHolder = ethnicity.getText().toString().trim();

    }

    public boolean checkValidMember1(){
        if(nameHolder1.equals(KEY_EMPTY)){
            if(relationHolder1.equals(KEY_EMPTY) &&  genderHolder1.equals(KEY_EMPTY) && ageHolder1.equals(KEY_EMPTY)  && educationHolder1.equals(KEY_EMPTY) && skills1Holder1.equals(KEY_EMPTY) && remarksHolder1.equals(KEY_EMPTY)){
                MemberHolder1 = "no family member";
                return true;

            }else{
                name1.setError("Name is required.");
                name1.requestFocus();
                return false;
            }
        }else{
            if(relationHolder1.equals(KEY_EMPTY)){
                relation1.setError("Relation is required");
                relation1.requestFocus();
                return false;
            }
            if(genderHolder1.equals(KEY_EMPTY)){
                member1_f.setError("Sex is reqiured");
                member1_f.requestFocus();
                return false;
            }
            if(ageHolder1.equals(KEY_EMPTY)){
                age1.setError("Age is required.");
                age1.requestFocus();
                return false;
            }
            if(educationHolder1.equals(KEY_EMPTY)){
                educationHolder1 = "n/a";
            }
            if(skills1Holder1.equals(KEY_EMPTY)){
                skills1Holder1 = "n/a";
            }
            if(remarksHolder1.equals(KEY_EMPTY)){
                remarksHolder1 = "n/a";
            }
            MemberHolder1 = "Name: " + nameHolder1 + "\nRelation to head: " + relationHolder1 + "\nAge: " + ageHolder1 + "\nSex: " + genderHolder1 + "\nEducation: " + educationHolder1 + "\nSkills: " + skills1Holder1 + "\nRemarks: " + remarksHolder1;
            return true;
        }
    }

    public boolean checkValidMember2(){
        if(nameHolder2.equals(KEY_EMPTY)){
            if(relationHolder2.equals(KEY_EMPTY) &&  genderHolder2.equals(KEY_EMPTY) && ageHolder2.equals(KEY_EMPTY)  && educationHolder2.equals(KEY_EMPTY) && skills1Holder2.equals(KEY_EMPTY) && remarksHolder2.equals(KEY_EMPTY)){
                MemberHolder2 = "no family member";
                return true;

            }else{
                name2.setError("Name is required.");
                name2.requestFocus();
                return false;
            }
        }else{
            if(relationHolder2.equals(KEY_EMPTY)){
                relation2.setError("Relation is required");
                relation2.requestFocus();
                return false;
            }
            if(genderHolder2.equals(KEY_EMPTY)){
                member2_f.setError("Sex is reqiured");
                member2_f.requestFocus();
                return false;
            }
            if(ageHolder2.equals(KEY_EMPTY)){
                age2.setError("Age is required.");
                age2.requestFocus();
                return false;
            }
            if(educationHolder2.equals(KEY_EMPTY)){
                educationHolder2 = "not applicable";
            }
            if(skills1Holder2.equals(KEY_EMPTY)){
                skills1Holder2 = "not applicable";
            }
            if(remarksHolder2.equals(KEY_EMPTY)){
                remarksHolder2 = "not applicable";
            }
            MemberHolder2 = "Name: " + nameHolder2 + "\nRelation to head: " + relationHolder2 + "\nAge: " + ageHolder2 + "\nSex: " + genderHolder2 + "\nEducation: " + educationHolder2 + "\nSkills: " + skills1Holder2 + "\nRemarks: " + remarksHolder2;
            return true;
        }
    }

    public boolean checkValidMember3(){
        if(nameHolder3.equals(KEY_EMPTY)){
            if(relationHolder3.equals(KEY_EMPTY) &&  genderHolder3.equals(KEY_EMPTY) && ageHolder3.equals(KEY_EMPTY)  && educationHolder3.equals(KEY_EMPTY) && skills1Holder3.equals(KEY_EMPTY) && remarksHolder3.equals(KEY_EMPTY)){
                MemberHolder3 = "no family member";
                return true;

            }else{
                name3.setError("Name is required.");
                name3.requestFocus();
                return false;
            }
        }else{
            if(relationHolder3.equals(KEY_EMPTY)){
                relation3.setError("Relation is required");
                relation3.requestFocus();
                return false;
            }
            if(genderHolder3.equals(KEY_EMPTY)){
                member3_f.setError("Sex is reqiured");
                member3_f.requestFocus();
                return false;
            }
            if(ageHolder3.equals(KEY_EMPTY)){
                age3.setError("Age is required.");
                age3.requestFocus();
                return false;
            }
            if(educationHolder3.equals(KEY_EMPTY)){
                educationHolder3 = "not applicable";
            }
            if(skills1Holder3.equals(KEY_EMPTY)){
                skills1Holder3 = "not applicable";
            }
            if(remarksHolder3.equals(KEY_EMPTY)){
                remarksHolder3 = "not applicable";
            }
            MemberHolder3 = "Name: " + nameHolder3 + "\nRelation to head: " + relationHolder3 + "\nAge: " + ageHolder3 + "\nSex: " + genderHolder3 + "\nEducation: " + educationHolder3 + "\nSkills: " + skills1Holder3 + "\nRemarks: " + remarksHolder3;
            return true;
        }
    }


}
