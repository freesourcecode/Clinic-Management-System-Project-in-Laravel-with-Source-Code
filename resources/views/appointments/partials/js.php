<script type="text/javascript">
        
 $(document).on('click', '.edit-appointment', function() {

        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#editAppointment').modal('show');
    
    

});

   function fillmodalData(details)
    {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#description').val(details[2]);
        $('#time').val(details[3]);
        $('#doctor_id').val(details[4]);
        $('#patient_id').val(details[5]);
        $('#date').val(details[6]);

    }


</script>
 