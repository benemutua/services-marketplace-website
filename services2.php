<div class="sorter">

<div class="sub-sorter"><!--start subsorter 1-->
<h5> <i class="ri-sort-desc"></i> Filter based on specific location?</h5>

<div class="input-group mb-1" > 
  <input type="text" name="speciality" value="" class="form-control" placeholder="Speciality Eg audit">
 <input type="text" name="locationAddress" value="" class="form-control" placeholder="Location" >
  <button type="submit" name="filterService" class="btn btn-success fa fa-search"></button>
</div>
</div><!--end sub sorter 1--->


<div class="sub-sorter"><!--start subsorter 2-->
<h5> <i class="fa fa-map-marker"></i> OR,Google Map Suggestion</h5>
<div class="input-group mb-1" > 
  <div class="form-check form-switch" style="border:1px solid gainsboro; padding-top:5px; background:ghostwhite;">
  <input class="form-check-input" type="checkbox" name="googleClose" id="flexSwitchCheckDefault">
  <label class="form-check-label" for="flexSwitchCheckDefault">Near Me</label>
</div>

<input type="text" name="speciality2" value="" class="form-control" placeholder="Speciality Eg audit" style="max-width:90%;">
<button type="submit" name="filterService" class="btn btn-success fa fa-search"></button>
</div>
</div><!--end sub sorter 2--->









.sorter{
  width: 100%;
  display: flex;
  margin-bottom: 15px;
  margin-top: 13px;
  grid-gap: 10px;
}
.sub-sorter{
  display: block;
  border: 1px solid whitesmoke;
  width: 49%;
  padding: 10px;
}

.sub-sorter h5{
  margin-top: -23px;
  position: absolute;
  background: white;
  text-align: center;
  border-radius: 5px;
  font-weight: 400;
  font-size: 15px;
  color: purple;
}

@media (max-width: 600px){

  .sorter{
    display: block;
    margin-bottom: 10px;
  }
  .sub-sorter{
    width: 100%;
  }

}



<form action="" method="post">

<div class="input-group px-3">  
  <?php require("fieldlist.php"); ?>
  <button type="submit" name="searchService"  id="searchMe" class="btn btn-success fa fa-search">Find</button>
</div>
</form>
