<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo "<script>alert('Journal entry saved successfully!');</script>";
    } elseif ($_GET['status'] === 'error') {
        echo "<script>alert('Failed to save journal entry.');</script>";
    }
    echo "<script>window.location.href = 'index.php';</script>";
}
?>


<div class="container">
    <!-- Button trigger modal -->
    <div class="row">
        <div class="table-responsive" id="journal_data"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        load_data();
        function load_data(hlm) {
            $.ajax({
                url: "journal_data.php",
                method: "POST",
                data: {
                    hlm: hlm
                },
                success: function (data) {
                    $('#journal_data').html(data);
                }
            })
        }

        $(document).on('click', '.halaman', function () {
            var hlm = $(this).attr("id");
            load_data(hlm);
        });
    });

</script>