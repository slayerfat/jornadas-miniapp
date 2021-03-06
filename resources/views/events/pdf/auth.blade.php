<div class="pdf-authorities">
  <?php
  $i = 0;
  $authorities = [1, 2, 3, 4];

  foreach ($event->professors as $professor) {
    if ($i === 0) {
      echo "<div class=\"group\">";
    }

    $title     = $professor->title ?
      $professor->title->desc : $professor->personalDetails->title->desc;
    $names     = $professor->personalDetails->first_name . " " .
      $professor->personalDetails->first_surname;
    $institute = $professor->institutes()->whereId($event->institute->id)->first();

    if ($professor->pivot) {
      $position = $professor->pivot->position;
    } elseif ($institute) {
      $position = $institute->pivot->position;
    } elseif ($professor->institutes->isEmpty()) {
      $position = null;
    } else {
      $position = $professor->institutes->random()->pivot->position;
    }

    if ($event->professors->count() == 1) {
      echo "<div class=\"pdf-single\">
        &#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;
        <br>
        $title $names
        <br>
        <span class=\"pdf-position\">$position</span>
      </div>
      </div>";
      // 2 divs porque es solo un div por lo
      // que el condicional $i == 1 nunca es verdadero
    } else {
      echo "<div class=\"pdf-name\">
        &#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;&#95;
        <br>
        $title $names
        <br>
        <span class=\"pdf-position\">$position</span>
      </div>";
    }

    if ($i === 1) {
      $i = 0;
      echo "</div>";
      continue;
    }
    $i++;
  }
  ?>
</div>