<?php
$sub_total = 0;
$total = 0;
?>
<div class="tickets">
    <form name="explara_attendee_forms" id="explara_attendee_forms" method="post">
        <div class="row">
            <div class="col-sm-12">
                <div class="explara_attendee_list">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>
                                ATTENDEE DETAILS
                            </h2>
                            <div id="explara_attendee_list_holder">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button type="submit" id="explara_submit_ticket_details" class="btn btn-primary">
                            Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
setTimeout(function(){ ExplaraCheckout.getAttendeeList(); }, 3000);
</script>