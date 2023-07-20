<script>

    $(document).ready(function () {
        changeConsulting()
        changeDealerDistributor()
        changeHospitalEmpanelmentAgent()
        changeSoftwareSales()
        changeOthers()
        changeCashlessManagement()
        changeCashlessHelpdesk()
        claimsAssessment()
        changeClaimsBill()
        claimsReimbursement()
        doctorClaimsProcess()
        doctorHonoraryPanel()
        doctorTeleConsultation()
        changeInsuranceTpa()
        medicalLendingBill()
        medicalLendingPatient()
    });
    function medicalLendingPatient() {
        var value = $('#medical_lending_patient').val();
        switch (value) {
            case "no":
                $('.div_medical_lending_patient').hide();
                break;
            case "yes":
                $('.div_medical_lending_patient').show();
                break;
            default:
                $('.div_medical_lending_patient').show();
                break;
        }
    }
    function medicalLendingPatient() {
        var value = $('#medical_lending_patient').val();
        switch (value) {
            case "no":
                $('.div_medical_lending_patient').hide();
                break;
            case "yes":
                $('.div_medical_lending_patient').show();
                break;
            default:
                $('.div_medical_lending_patient').show();
                break;
        }
    }

    function medicalLendingBill() {
        var value = $('#medical_lending_bill').val();
        switch (value) {
            case "no":
                $('.div_medical_lending_bill').hide();
                break;
            case "yes":
                $('.div_medical_lending_bill').show();
                break;
            default:
                $('.div_medical_lending_bill').show();
                break;
        }
    }

    function changeInsuranceTpa() {
        var value = $('#insurance_tpa_coordination').val();
        switch (value) {
            case "no":
                $('.div_insurance_tpa_coordination').hide();
                break;
            case "yes":
                $('.div_insurance_tpa_coordination').show();
                break;
            default:
                $('.div_insurance_tpa_coordination').show();
                break;
        }
    }

    function doctorTeleConsultation() {
        var value = $('#doctor_tele_consultation').val();
        switch (value) {
            case "no":
                $('.div_doctor_tele_consultation').hide();
                break;
            case "yes":
                $('.div_doctor_tele_consultation').show();
                break;
            default:
                $('.div_doctor_tele_consultation').show();
                break;
        }
    }

    function doctorHonoraryPanel() {
        var value = $('#doctor_honorary_panel').val();
        switch (value) {
            case "no":
                $('.div_doctor_honorary_panel').hide();
                break;
            case "yes":
                $('.div_doctor_honorary_panel').show();
                break;
            default:
                $('.div_doctor_honorary_panel').show();
                break;
        }
    }

    function doctorClaimsProcess() {
        var value = $('#doctor_claim_process').val();
        switch (value) {
            case "no":
                $('.div_doctor_claim_process').hide();
                break;
            case "yes":
                $('.div_doctor_claim_process').show();
                break;
            default:
                $('.div_doctor_claim_process').show();
                break;
        }
    }

    function claimsReimbursement() {
        var value = $('#claims_reimbursement').val();
        switch (value) {
            case "no":
                $('.div_claims_reimbursement').hide();
                break;
            case "yes":
                $('.div_claims_reimbursement').show();
                break;
            default:
                $('.div_claims_reimbursement').show();
                break;
        }
    }

    function changeClaimsBill() {
        var value = $('#claims_bill_entry').val();
        switch (value) {
            case "no":
                $('.div_claims_bill_entry').hide();
                break;
            case "yes":
                $('.div_claims_bill_entry').show();
                break;
            default:
                $('.div_claims_bill_entry').show();
                break;
        }
    }

    function claimsAssessment() {
        var value = $('#claims_assessment').val();
        switch (value) {
            case "no":
                $('.div_claims_assessment').hide();
                break;
            case "yes":
                $('.div_claims_assessment').show();
                break;
            default:
                $('.div_claims_assessment').show();
                break;
        }
    }

    function changeCashlessHelpdesk() {
        var value = $('#cashless_helpdesk').val();
        switch (value) {
            case "no":
                $('.div_cashless_helpdesk').hide();
                break;
            case "yes":
                $('.div_cashless_helpdesk').show();
                break;
            default:
                $('.div_cashless_helpdesk').show();
                break;
        }
    }

    function changeCashlessManagement() {
        var value = $('#cashless_claims_management').val();
        switch (value) {
            case "no":
                $('.div_cashless_claims_management').hide();
                break;
            case "yes":
                $('.div_cashless_claims_management').show();
                break;
            default:
                $('.div_cashless_claims_management').show();
                break;
        }
    }

    function changeConsulting() {
        var value = $('#consulting').val();
        switch (value) {
            case "no":
                $('.div_consulting').hide();
                break;
            case "yes":
                $('.div_consulting').show();
                break;
            default:
                $('.div_consulting').show();
                break;
        }
    }

    function changeDealerDistributor() {
        var value = $('#dealer_distributor').val();
        switch (value) {
            case "no":
                $('.div_dealer_distributor').hide();
                break;
            case "yes":
                $('.div_dealer_distributor').show();
                break;
            default:
                $('.div_dealer_distributor').show();
                break;
        }
    }

    function changeHospitalEmpanelmentAgent() {
        var value = $('#hospital_empanelment_agent').val();
        switch (value) {
            case "no":
                $('.div_hospital_empanelment_agent').hide();
                break;
            case "yes":
                $('.div_hospital_empanelment_agent').show();
                break;
            default:
                $('.div_hospital_empanelment_agent').show();
                break;
        }
    }

    function changeSoftwareSales() {
        var value = $('#software_sales').val();
        switch (value) {
            case "no":
                $('.div_software_sales').hide();
                break;
            case "yes":
                $('.div_software_sales').show();
                break;
            default:
                $('.div_software_sales').show();
                break;
        }
    }

    function changeOthers() {
        var value = $('#others').val();
        switch (value) {
            case "no":
                $('.div_others').hide();
                break;
            case "yes":
                $('.div_others').show();
                break;
            default:
                $('.div_others').show();
                break;
        }
    }
</script>
