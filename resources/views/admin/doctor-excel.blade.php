<form action="" enctype="multipart/form-data" method="post">
    {{csrf_field()}}
    <input type="file" name="doctor-information">
    <button type="submit">submit</button>
</form>