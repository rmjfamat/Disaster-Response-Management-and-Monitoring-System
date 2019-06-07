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

public class Register2 extends AppCompatActivity {

    private static final String KEY_TABLE_NAME = "table_name";
    private static final String KEY_FIRSTNAME = "firstname";
    private static final String KEY_MIDDLENAME = "middlename";
    private static final String KEY_LASTNAME = "lastname";
    private static final String KEY_HEAD_AGE = "head_age";
    private static final String KEY_HEAD_GENDER = "headGender";
    private static final String KEY_ADDRESS = "address";
    private static final String KEY_CIVIL_STATUS = "civil_status";
    private static final String KEY_BDATE = "headBirthdate";
    private static final String KEY_OCCUPATION = "occupation";
    private static final String KEY_INCOME = "income";
    private static final String KEY_RESIDENT_CATEGORY = "residentCategory";
    private static final String KEY_SHARER_OF = "sharerOf";
    private static final String KEY_RENTER_OF = "renterOf";
    private static final String KEY_LODGER_OF = "lodgerOf";
    private static final String KEY_ESTIMATED_DAMAGES = "estimatedDamages";
    private static final String KEY_SPECIAL = "specialSpecs";
    private static final String KEY_HEALTH = "healthCondition";
    private static final String KEY_ETHNICITY = "ethnicity";
    private static final String KEY_FPS = "FPSMember";
    private static final String KEY_FAMILY_1 = "familyMember_1";
    private static final String KEY_FAMILY_2 = "familyMember_2";
    private static final String KEY_FAMILY_3 = "familyMember_3";
    private static final String KEY_VERIFY = "verified";

    private static final String KEY_SOURCE_INFO = "infoSource";
    private static final String KEY_WITNESS = "witness";
    private static final String KEY_INTERVIEWER = "interviewer";
    private static final String KEY_DATE_REG = "dateRegistered";
    private static final String KEY_VALIDATOR = "validator";
    private static final String KEY_DATE_VALID = "dateValidated";

    private static final String KEY_EMPTY = "";

    IPUrl ipUrl = new IPUrl();
    String ip = ipUrl.getIpadress();
    private String HttpUrl = "http://" + ip + "/dswsapp/insertdata.php";
    String passedName = "";

    EditText firstname, middlename, surname, head_age, address, civil_status, bdate, occupation, income, sharerOf, renterOf, lodgerof, estimate, ethnicity, infoSrc, witness, interviewer, dateRegistered, validator, dateValidated;
    RadioGroup head_gender, residentCategory, specialSpecs, health_condition;
    RadioButton head_gender_checked, residentCategory_checked, specialSpecs_checked, health_condition_checked;
    RadioButton head_f, house_f, member1_f, member2_f, member3_f, member4_f, code_f, health_f;

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
    String FirstNameHolder, MiddleNameHolder, LastNameHolder, HeadAgeHolder, HeadGenderHolder, AddressHolder, CivilStatusHolder, BirthdateHolder, OccupationHolder, HeadIncomeHolder, ResidentCategoryHolder, EstimateDamageHolder, SharerOfHolder, RenterOfHolder, LodgerOfHolder, SpecialSpecsHolder, HealthConditionHolder, EthnicityHolder, FourPsHolder, VerifyHolder, InfoSourceHolder, WitnessHolder, InterviewerHolder, DateRegHolder, ValidatorHolder, DateValHolder;

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
        firstname = findViewById(R.id.firstname);
        middlename = findViewById(R.id.middlename);
        surname = findViewById(R.id.surname);

        String[] sep = passedName.split(" ");
        if(sep.length == 2){
            firstname.setText(sep[0]);
            surname.setText(sep[1]);
        }else{
            if(sep.length == 3){
                firstname.setText(sep[0] + " " + sep[1]);
                surname.setText(sep[2]);
            }else if(sep.length == 3){
                firstname.setText(sep[0] + " " + sep[1] + " " + sep[2]);
                surname.setText(sep[3]);
            }
        }

        head_age = findViewById(R.id.head_age);
        address = findViewById(R.id.address);
        civil_status = findViewById(R.id.civil_status);
        occupation = findViewById(R.id.occupation_input);
        bdate = findViewById(R.id.bday_date);
        income = findViewById(R.id.income_input);
        estimate = findViewById(R.id.estimateddamages);
        ethnicity = findViewById(R.id.ethnicity);
        four_ps = findViewById(R.id.fourps);
        verify = findViewById(R.id.verif);
        sharerOf = findViewById(R.id.sharerOf);
        renterOf = findViewById(R.id.renterOf);
        lodgerof = findViewById(R.id.lodgerOf);
        infoSrc = findViewById(R.id.infoSource);
        witness = findViewById(R.id.witness);
        interviewer = findViewById(R.id.interviewer);
        dateRegistered = findViewById(R.id.date_registered);
        validator = findViewById(R.id.validator);
        dateValidated = findViewById(R.id.date_validated);

        if(ver == 1){
            verify.setChecked(true);
        }else{
            verify.setChecked(false);
        }

        addMember = findViewById(R.id.addFamily);
        InsertButton = findViewById(R.id.insert_btn);
        requestQueue = Volley.newRequestQueue(Register2.this);

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
                head_gender = findViewById(R.id.radioGroupHead);
                selectedId = head_gender.getCheckedRadioButtonId();
                head_f = findViewById(R.id.head_female);

                residentCategory = findViewById(R.id.houseCase);
                selectedId_houseCase = residentCategory.getCheckedRadioButtonId();
                house_f = findViewById(R.id.owner);

                specialSpecs = findViewById(R.id.victimCode);
                selectedIdVictimCode = specialSpecs.getCheckedRadioButtonId();
                code_f = findViewById(R.id.codeA);

                health_condition = findViewById(R.id.healthCode);
                selectedIdHealthCon = health_condition.getCheckedRadioButtonId();
                health_f = findViewById(R.id.health01);

                if(selectedId == -1){
                    HeadGenderHolder = KEY_EMPTY;
                }else{
                    head_gender_checked = findViewById(selectedId);
                    HeadGenderHolder = head_gender_checked.getText().toString().trim();
                }

                if(selectedId_houseCase == -1){
                    ResidentCategoryHolder = KEY_EMPTY;
                }else{
                    residentCategory_checked = findViewById(selectedId_houseCase);
                    ResidentCategoryHolder = residentCategory_checked.getText().toString().trim();
                }

                if(selectedIdVictimCode == -1){
                    SpecialSpecsHolder = KEY_EMPTY;
                }else{
                    specialSpecs_checked = findViewById(selectedIdVictimCode);
                    SpecialSpecsHolder = specialSpecs_checked.getText().toString().trim();
                }

                if(selectedIdHealthCon == -1){
                    HealthConditionHolder = KEY_EMPTY;
                }else{
                    health_condition_checked = findViewById(selectedIdHealthCon);
                    HealthConditionHolder = health_condition_checked.getText().toString().trim();
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
                        Toast.makeText(getApplicationContext(), "Select head gender.", Toast.LENGTH_LONG).show();
                    }else if(ResidentCategoryHolder.equals(KEY_EMPTY)) {
                        Toast.makeText(getApplicationContext(), "Select resident category.", Toast.LENGTH_LONG).show();
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
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Register2.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(ServerResponse);
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                startActivity(new Intent(Register2.this, Update.class));
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
                        AlertDialog.Builder builder1 = new AlertDialog.Builder(Register2.this);
                        builder1.setTitle("Action Response:");
                        builder1.setMessage(volleyError.toString());
                        builder1.setCancelable(false);
                        builder1.setPositiveButton("Back to Home", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                startActivity(new Intent(Register2.this,Home.class));
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
                params.put(KEY_FIRSTNAME, FirstNameHolder);
                params.put(KEY_LASTNAME, LastNameHolder);
                params.put(KEY_MIDDLENAME, MiddleNameHolder);
                params.put(KEY_HEAD_AGE, HeadAgeHolder);
                params.put(KEY_HEAD_GENDER, HeadGenderHolder);
                params.put(KEY_ADDRESS, AddressHolder);
                params.put(KEY_CIVIL_STATUS, CivilStatusHolder);
                params.put(KEY_BDATE, BirthdateHolder);
                params.put(KEY_OCCUPATION, OccupationHolder);
                params.put(KEY_INCOME, HeadIncomeHolder);
                params.put(KEY_RESIDENT_CATEGORY, ResidentCategoryHolder);
                params.put(KEY_RENTER_OF, RenterOfHolder);
                params.put(KEY_SHARER_OF, SharerOfHolder);
                params.put(KEY_LODGER_OF, LodgerOfHolder);
                params.put(KEY_ESTIMATED_DAMAGES, EstimateDamageHolder);
                params.put(KEY_SPECIAL, SpecialSpecsHolder);
                params.put(KEY_HEALTH, HealthConditionHolder);
                params.put(KEY_ETHNICITY, EthnicityHolder);
                params.put(KEY_FPS, FourPsHolder);
                params.put(KEY_FAMILY_1, MemberHolder1);
                params.put(KEY_FAMILY_2, MemberHolder2);
                params.put(KEY_FAMILY_3, MemberHolder3);
                params.put(KEY_VERIFY, VerifyHolder);
                params.put(KEY_SOURCE_INFO, InfoSourceHolder);
                params.put(KEY_WITNESS, WitnessHolder);
                params.put(KEY_INTERVIEWER, InterviewerHolder);
                params.put(KEY_DATE_REG, DateRegHolder);
                params.put(KEY_VALIDATOR, ValidatorHolder);
                params.put(KEY_DATE_VALID, DateValHolder);

                return params;
            }

        };

        // Creating RequestQueue.
        RequestQueue requestQueue = Volley.newRequestQueue(Register2.this);

        // Adding the StringRequest object into requestQueue.
        requestQueue.add(stringRequest);
    }

    private boolean validateInputs() {
        if (KEY_EMPTY.equals(FirstNameHolder)) {
            firstname.setError("Cannot be empty");
            firstname.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(MiddleNameHolder)) {
            middlename.setError("Cannot be empty");
            middlename.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(LastNameHolder)) {
            surname.setError("Cannot be empty");
            surname.requestFocus();
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

        if (KEY_EMPTY.equals(ResidentCategoryHolder)) {
            house_f.setError("Cannot be empty");
            house_f.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(InterviewerHolder)) {
            interviewer.setError("Cannot be empty");
            interviewer.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(DateRegHolder)) {
            dateRegistered.setError("Cannot be empty");
            dateRegistered.requestFocus();
            return false;
        }

        if (KEY_EMPTY.equals(InterviewerHolder)) {
            interviewer.setError("Cannot be empty");
            interviewer.requestFocus();
            return false;
        }

        if(!(KEY_EMPTY.equals(VerifyHolder))){
            if (KEY_EMPTY.equals(ValidatorHolder)) {
                validator.setError("Cannot be empty");
                validator.requestFocus();
                return false;
            }

            if (KEY_EMPTY.equals(ValidatorHolder)) {
                validator.setError("Cannot be empty");
                validator.requestFocus();
                return false;
            }
        }

        return true;
    }

    //show dialogue

    private void displayLoader() {
        pDialog = new ProgressDialog(Register2.this);
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
        FirstNameHolder = firstname.getText().toString().trim();
        MiddleNameHolder = middlename.getText().toString().trim();
        LastNameHolder = surname.getText().toString().trim();
        HeadAgeHolder = head_age.getText().toString().trim();
        AddressHolder = address.getText().toString().trim();
        OccupationHolder = occupation.getText().toString().trim();
        BirthdateHolder = bdate.getText().toString().trim();
        HeadIncomeHolder = income.getText().toString().trim();
        EthnicityHolder = ethnicity.getText().toString().trim();
        CivilStatusHolder = civil_status.getText().toString().trim();
        EstimateDamageHolder = estimate.getText().toString().trim();
        SharerOfHolder = sharerOf.getText().toString().trim();
        RenterOfHolder = renterOf.getText().toString().trim();
        LodgerOfHolder = lodgerof.getText().toString().trim();
        InfoSourceHolder = infoSrc.getText().toString().trim();
        WitnessHolder = witness.getText().toString().trim();
        InterviewerHolder = interviewer.getText().toString().trim();
        DateRegHolder = dateRegistered.getText().toString().trim();
        ValidatorHolder = validator.getText().toString().trim();
        DateValHolder = dateValidated.getText().toString().trim();


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
                genderHolder1 = "n/a";
            }
            if(ageHolder1.equals(KEY_EMPTY)){
                ageHolder1 = "n/a";
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
                genderHolder2 = "n/a";
            }
            if(ageHolder2.equals(KEY_EMPTY)){
                ageHolder2 = "n/a";
            }
            if(educationHolder2.equals(KEY_EMPTY)){
                educationHolder2 = "n/a";
            }
            if(skills1Holder2.equals(KEY_EMPTY)){
                skills1Holder2 = "n/a";
            }
            if(remarksHolder2.equals(KEY_EMPTY)){
                remarksHolder1 = "n/a";
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
                genderHolder3 = "n/a";
            }
            if(ageHolder3.equals(KEY_EMPTY)){
                ageHolder3 = "n/a";
            }
            if(educationHolder3.equals(KEY_EMPTY)){
                educationHolder3 = "n/a";
            }
            if(skills1Holder3.equals(KEY_EMPTY)){
                skills1Holder3 = "n/a";
            }
            if(remarksHolder3.equals(KEY_EMPTY)){
                remarksHolder1 = "n/a";
            }
            MemberHolder3 = "Name: " + nameHolder3 + "\nRelation to head: " + relationHolder3 + "\nAge: " + ageHolder3 + "\nSex: " + genderHolder3 + "\nEducation: " + educationHolder3 + "\nSkills: " + skills1Holder3 + "\nRemarks: " + remarksHolder3;
            return true;
        }
    }

}
