<form action="" method="post">
<div class="form-group">
  <label class="form-control-label"  for="input1">Užduoties pavadinimas</label>
  <input type="text" class="form-control" name="pavadinimas" value="{$pavadinimas}" id="input1" required/>
</div>
<label class="form-control-label"  for="input1">  Užduoties sunkumas</label>
<div class="form-select">
  <select class="form-control custom-select" name="pasirinkimas" selected="2" value="3">
    <option value="1"  {if $pasirinkimas == 1} selected {/if} > Lengva</option>
    <option value="2" {if $pasirinkimas == 2} selected {/if}> Vidutiniškai sunki</option>
    <option value="3" {if $pasirinkimas == 3} selected {/if} > Sunki</option>
  </select>
</div>
<button type="submit" class="btn btn-danger">Išsaugoti</button>
</form>