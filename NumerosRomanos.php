<?php declare(strict_types=1);
final class NumerosRomanos
{
  // grupos dos dígitos
  private static $grupos = array(
    1 => 1, 2 => 1, 3 => 1,
    4 => 2, 5 => 2, 6 => 2, 7 => 2, 8 => 2,
    9 => 3, 0 => 3
  );
  // correspondência em texto para grupos de algarismos
  private static $gruposTexto = array(
    0 => "", 1 => "I",
    2 => "V", 3 => "X",
    4 => "L", 5 => "C",
    6 => "D", 7 => "M"
  );
  // multiplicador baseado em quantidade de algarismos, para definir grandeza do grupo
  private static $grandezas = array(
    0 => 0, 1 => 2,
    2 => 4, 3 => 6
  );
  // posicionamento do dígito, para definir se receberá algarismos romanos adjacentes
  private static $posicao = array(
    0 => 0, 5 => 0,
    1 => 1, 6 => 1,
    2 => 2, 7 => 2,
    3 => 3, 8 => 3,
    4 => -1, 9 => -1
  );

  static function numeroArabico($numeroArabico) {
    if (is_int($numeroArabico)) {
      return $numeroArabico;
    } else {
      throw new Exception('Numero invalido');
    }
  }
  static function numeroRomanoLimite($numeroArabico) {
    if ($numeroArabico < 1 || $numeroArabico >= 4000) {
      throw new Exception('Fora do limite');
    }
  }
  static function numeroRomanoUnidade($numeroArabico) {
    return substr(strval(floor($numeroArabico)),-1);
  }
  static function numeroRomanoGrandeza($posicao) {
    return self::$grandezas[$posicao];
  }
  static function numeroRomanoPosicao($digito) {
    return self::$posicao[$digito];
  }
  static function numeroRomanoGrupo($digito, $grandeza) {
    return self::$grupos[$digito] + $grandeza;
  }
  static function numeroRomanoGrupoTexto($grupo) {
    return self::$gruposTexto[$grupo];
  }
  static function numeroRomanoGrupoAdjacente($grupo) {
    return $grupo % 2 === 0 ? $grupo - 1 : $grupo - 2;
  }
  static function numeroRomanoPrecisaGrupoAdjacente($digito) {
    return ($digito == 4 || $digito > 5);
  }
  static function numeroRomanoDigitoTexto($grupo, $posicao) {
    if ($posicao < 0 || $grupo % 2 === 0) {
      return self::numeroRomanoGrupoTexto($grupo);
    } else {
      return str_pad("", $posicao, self::numeroRomanoGrupoTexto($grupo), STR_PAD_RIGHT);
    }
  }
  static function numeroRomanoDigitoTextoAdjacente($texto, $grupo_adjacente, $posicao) {
    if ($posicao < 0) {
      return str_pad($texto, 2, self::numeroRomanoGrupoTexto($grupo_adjacente), STR_PAD_LEFT);
    } else {
      return str_pad($texto, $posicao+1, self::numeroRomanoGrupoTexto($grupo_adjacente), STR_PAD_RIGHT);
    }
  }
  static function numeroRomano($numeroArabico) {
    $numeroRomano = array();
    for ($i=0;$i<strlen(strval($numeroArabico));$i++) {
      $numeroRomano[$i]['digito'] = NumerosRomanos::numeroRomanoUnidade($numeroArabico / intval(str_pad("1", $i+1, "0", STR_PAD_RIGHT)));
      $numeroRomano[$i]['posicao'] = NumerosRomanos::numeroRomanoPosicao($numeroRomano[$i]['digito']);
      $numeroRomano[$i]['grandeza'] = NumerosRomanos::numeroRomanoGrandeza($i);
      $numeroRomano[$i]['grupo'] = NumerosRomanos::numeroRomanoGrupo($numeroRomano[$i]['digito'], $numeroRomano[$i]['grandeza']);
      $numeroRomano[$i]['grupo_adjacente'] = NumerosRomanos::numeroRomanoGrupoAdjacente($numeroRomano[$i]['grupo']);
      $numeroRomano[$i]['digito_texto'] = NumerosRomanos::numeroRomanoDigitoTexto($numeroRomano[$i]['grupo'], $numeroRomano[$i]['posicao']);
      $numeroRomano[$i]['digito_texto_adjacente'] = NumerosRomanos::numeroRomanoPrecisaGrupoAdjacente($numeroRomano[$i]['digito'])?NumerosRomanos::numeroRomanoDigitoTextoAdjacente($numeroRomano[$i]['digito_texto'], $numeroRomano[$i]['grupo_adjacente'], $numeroRomano[$i]['posicao']):"";
      $numeroRomano[$i]['numero_romano'] = $numeroRomano[$i]['digito_texto_adjacente']!=''?$numeroRomano[$i]['digito_texto_adjacente']:$numeroRomano[$i]['digito_texto'];
    }
    $numeroRomanoTexto = "";
    for ($i = (count($numeroRomano)-1); $i >= 0; $i--) {
      $numeroRomanoTexto .= $numeroRomano[$i]['numero_romano'];
    }
    return $numeroRomanoTexto;
  }
}
