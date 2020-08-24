<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once "src/NumerosRomanos.php";
final class NumerosRomanosTest extends TestCase {
  public function testNumeroValido(): void {
    $this->expectErrorMessage('Numero invalido');
    // numerosRomanos::numeroArabico('abc');
    numerosRomanos::numeroArabico('0.1');
    // numerosRomanos::numeroArabico('1e8');
    // numerosRomanos::numeroArabico(12);
  }
  public function testNumeroAcimadoLimite(): void {
    $this->expectErrorMessage('Fora do limite');
    // numerosRomanos::numeroRomanoLimite(0);
    numerosRomanos::numeroRomanoLimite(4000);
  }
  public function testNumeroRomanoUnidade(): void {
    $this->assertEquals(6, numerosRomanos::numeroRomanoUnidade(2486));
  }
  public function testNumeroRomanoDezena(): void {
    // $this->assertEquals(8, numerosRomanos::numeroRomanoUnidade(2486/10));
    $this->assertEquals(0, numerosRomanos::numeroRomanoUnidade(6/10));
  }
  public function testNumeroRomanoCentena(): void {
    // $this->assertEquals(4, numerosRomanos::numeroRomanoUnidade(2486/100));
    $this->assertEquals(0, numerosRomanos::numeroRomanoUnidade(86/100));
  }
  public function testNumeroRomanoMilhar(): void {
    // $this->assertEquals(2, numerosRomanos::numeroRomanoUnidade(2486/1000));
    $this->assertEquals(0, numerosRomanos::numeroRomanoUnidade(486/1000));
  }
  public function testNumeroRomanoGrandeza(): void {
    $this->assertEquals(2, numerosRomanos::numeroRomanoGrandeza(1));
  }
  public function testNumeroRomanoPosicao(): void {
    $this->assertEquals(0, numerosRomanos::numeroRomanoPosicao(5));
  }
  public function testNumeroRomanoGrupo(): void {
    $this->assertEquals(6, numerosRomanos::numeroRomanoGrupo(5, 4));
  }
  public function testNumeroRomanoGrupoTexto(): void {
    $this->assertEquals('V', numerosRomanos::numeroRomanoGrupoTexto(2));
  }
  public function testNumeroRomanoGrupoAdjacente(): void {
    $this->assertEquals(5, numerosRomanos::numeroRomanoGrupoAdjacente(7));
  }
  public function testNumeroRomanoPrecisaGrupoAdjacente(): void {
    $this->assertEquals(true, numerosRomanos::numeroRomanoPrecisaGrupoAdjacente(4));
  }
  public function testNumeroRomanoDigitoTexto(): void {
    $this->assertEquals('V', numerosRomanos::numeroRomanoDigitoTexto(2, -1));
  }
  public function testNumeroRomanoDigitoTextoAdjacente(): void {
    $this->assertEquals('IV', numerosRomanos::numeroRomanoDigitoTextoAdjacente('V', 1, -1));
  }
  public function testNumeroRomano(): void {
    $this->assertEquals('CDX', numerosRomanos::numeroRomano(410));
  }
}
