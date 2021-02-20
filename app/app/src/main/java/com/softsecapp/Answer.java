package com.softsecapp;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Answer {

    @SerializedName("emnekode")
    @Expose
    private String emnekode;

    @SerializedName("melding")
    @Expose
    private String melding;

    @SerializedName("svar")
    @Expose
    private String svar;

    public void getAnswer (String emnekode, String melding, String svar) {
        this.emnekode = emnekode;
        this.melding = melding;
        this.svar = svar;
    }

    public String getEmnekode() {
        return emnekode;
    }


    public String getMelding() {
        return melding;
    }

    public String getSvar() {
        return svar;
    }
}
