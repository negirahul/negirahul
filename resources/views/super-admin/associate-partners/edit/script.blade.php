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
                $('#medical_lending_patient_charge').attr('readonly', true);
                break;
            case "yes":
                $('#medical_lending_patient_charge').attr('readonly', false);
                break;
            default:
                $('#medical_lending_patient_charge').attr('readonly', true);
                break;
        }
    }    

    function medicalLendingBill() {
        var value = $('#medical_lending_bill').val();
        switch (value) {
            case "no":
                $('#medical_lending_bill_charge').attr('readonly', true);
                break;
            case "yes":
                $('#medical_lending_bill_charge').attr('readonly', false);
                break;
            default:
                $('#medical_lending_bill_charge').attr('readonly', true);
                break;
        }
    }

    function changeInsuranceTpa() {
        var value = $('#insurance_tpa_coordination').val();
        switch (value) {
            case "no":
                $('#insurance_tpa_coordination_charge').attr('readonly', true);
                break;
            case "yes":
                $('#insurance_tpa_coordination_charge').attr('readonly', false);
                break;
            default:
                $('#insurance_tpa_coordination_charge').attr('readonly', true);
                break;
        }
    }

    function doctorTeleConsultation() {
        var value = $('#doctor_tele_consultation').val();
        switch (value) {
            case "no":
                $('#doctor_tele_consultation_charge').attr('readonly', true);
                break;
            case "yes":
                $('#doctor_tele_consultation_charge').attr('readonly', false);
                break;
            default:
                $('#doctor_tele_consultation_charge').attr('readonly', true);
                break;
        }
    }

    function doctorHonoraryPanel() {
        var value = $('#doctor_honorary_panel').val();
        switch (value) {
            case "no":
                $('#doctor_honorary_panel_charge').attr('readonly', true);
                break;
            case "yes":
                $('#doctor_honorary_panel_charge').attr('readonly', false);
                break;
            default:
                $('#doctor_honorary_panel_charge').attr('readonly', true);
                break;
        }
    }

    function doctorClaimsProcess() {
        var value = $('#doctor_claim_process').val();
        switch (value) {
            case "no":
                $('#doctor_claim_process_charge').attr('readonly', true);
                break;
            case "yes":
                $('#doctor_claim_process_charge').attr('readonly', false);
                break;
            default:
                $('#doctor_claim_process_charge').attr('readonly', true);
                break;
        }
    }

    function claimsReimbursement() {
        var value = $('#claims_reimbursement').val();
        switch (value) {
            case "no":
                $('#claims_reimbursement_charge').attr('readonly', true);
                break;
            case "yes":
                $('#claims_reimbursement_charge').attr('readonly', false);
                break;
            default:
                $('#claims_reimbursement_charge').attr('readonly', true);
                break;
        }
    }

    function changeClaimsBill() {
        var value = $('#claims_bill_entry').val();
        switch (value) {
            case "no":
                $('#claims_bill_entry_charge').attr('readonly', true);
                break;
            case "yes":
                $('#claims_bill_entry_charge').attr('readonly', false);
                break;
            default:
                $('#claims_bill_entry_charge').attr('readonly', true);
                break;
        }
    }

    function claimsAssessment() {
        var value = $('#claims_assessment').val();
        switch (value) {
            case "no":
                $('#claims_assessment_charge').attr('readonly', true);
                break;
            case "yes":
                $('#claims_assessment_charge').attr('readonly', false);
                break;
            default:
                $('#claims_assessment_charge').attr('readonly', true);
                break;
        }
    }

    function changeCashlessHelpdesk() {
        var value = $('#cashless_helpdesk').val();
        switch (value) {
            case "no":
                $('#cashless_helpdesk_charge').attr('readonly', true);
                break;
            case "yes":
                $('#cashless_helpdesk_charge').attr('readonly', false);
                break;
            default:
                $('#cashless_helpdesk_charge').attr('readonly', true);
                break;
        }
    }

    function changeCashlessManagement() {
        var value = $('#cashless_claims_management').val();
        switch (value) {
            case "no":
                $('#cashless_claims_management_charge').attr('readonly', true);
                break;
            case "yes":
                $('#cashless_claims_management_charge').attr('readonly', false);
                break;
            default:
                $('#cashless_claims_management_charge').attr('readonly', true);
                break;
        }
    }

    function changeConsulting() {
        var value = $('#consulting').val();
        switch (value) {
            case "no":
                $('#consulting_charge').attr('readonly', true);
                break;
            case "yes":
                $('#consulting_charge').attr('readonly', false);
                break;
            default:
                $('#consulting_charge').attr('readonly', true);
                break;
        }
    }

    function changeDealerDistributor() {
        var value = $('#dealer_distributor').val();
        switch (value) {
            case "no":
                $('#dealer_distributor_charge').attr('readonly', true);
                break;
            case "yes":
                $('#dealer_distributor_charge').attr('readonly', false);
                break;
            default:
                $('#dealer_distributor_charge').attr('readonly', true);
                break;
        }
    }

    function changeHospitalEmpanelmentAgent() {
        var value = $('#hospital_empanelment_agent').val();
        switch (value) {
            case "no":
                $('#hospital_empanelment_agent_charge').attr('readonly', true);
                break;
            case "yes":
                $('#hospital_empanelment_agent_charge').attr('readonly', false);
                break;
            default:
                $('#hospital_empanelment_agent_charge').attr('readonly', true);
                break;
        }
    }

    function changeSoftwareSales() {
        var value = $('#software_sales').val();
        switch (value) {
            case "no":
                $('#software_sales_charge').attr('readonly', true);
                break;
            case "yes":
                $('#software_sales_charge').attr('readonly', false);
                break;
            default:
                $('#software_sales_charge').attr('readonly', true);
                break;
        }
    }

    function changeOthers() {
        var value = $('#others').val();
        switch (value) {
            case "no":
                $('#others_charge').attr('readonly', true);
                break;
            case "yes":
                $('#others_charge').attr('readonly', false);
                break;
            default:
                $('#others_charge').attr('readonly', true);
                break;
        }
    }
</script>

<script>
    $(document).ready(function(){
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>
