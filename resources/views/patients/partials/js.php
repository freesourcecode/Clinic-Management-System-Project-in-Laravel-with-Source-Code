<script type="text/javascript">
        $("#deleteConfirm").submit(function (event) {
            var x = confirm("Are you sure you want to delete?");
            if (x) {
                return true;
            }
            else {

                event.preventDefault();
                return false;
            }

        });
    </script><script type="text/javascript">
  
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

    }

      

</script>