<form class="p-5" method="GET" action="./ads.php">
  <div class="row mb-3">
    <div class="col">
      <label for="manufacturer" class="form-label">Značka</label>
      <input name="manufacturer" type="text" class="form-control" id="manufacturer">
    </div>
    <div class="col">
      <label for="model" class="form-label">Model</label>
      <input name="model" type="text" class="form-control" id="model">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col">
      <label class="form-label" for="fuel">Palivo:</label>
      <select class="form-control" id="fuel" name="fuel">
        <option value="">Vyberte druh paliva</option>
        <option value="Benzín">Benzín</option>
        <option value="Nafta">Nafta</option>
        <option value="Hybrid">Hybrid</option>
        <option value="Elektro">Elektro</option>
      </select>
    </div>
    <div class="col">
      <label for="color" class="form-label">Farba</label>
      <input name="color" type="text" class="form-control" id="color">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col">
      <label for="yearFrom" class="form-label">Rok od</label>
      <input name="yearFrom" type="text" class="form-control" id="yearFrom">
    </div>
    <div class="col">
      <label for="yearTo" class="form-label">Rok do</label>
      <input name="yearTo" type="text" class="form-control" id="yearTo">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col">
      <label for="powerFrom" class="form-label">Výkon od</label>
      <input name="powerFrom" type="text" class="form-control" id="powerFrom">
    </div>
    <div class="col">
      <label for="powerTo" class="form-label">Výkon do</label>
      <input name="powerTo" type="text" class="form-control" id="powerTo">
    </div>
  </div>
  <div class="row mb-3">
    <div class="col">
      <label for="priceFrom" class="form-label">Cena od</label>
      <input name="priceFrom" type="text" class="form-control" id="priceFrom">
    </div>
    <div class="col">
      <label for="priceTo" class="form-label">Cena do</label>
      <input name="priceTo" type="text" class="form-control" id="priceTo">
    </div>
  </div>
  <div class="row">
    <div class="col">
      <button type="submit" class="btn btn-primary btn-block w-100 mt-4">Hľadaj</button>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col">
      <form action="./ads.php" method="GET" id="view">
        <button type="submit" class="btn btn-outline-primary  btn-block w-100 mt-4">Prezerať databázu</button>
      </form>
    </div>
  </div>
</form>