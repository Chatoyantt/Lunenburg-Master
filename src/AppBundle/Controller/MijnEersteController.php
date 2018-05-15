<?php
//Namespace en uses, mag je vergeten. Moet er wel in staan!
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Klant;
use AppBundle\Form\Type\KlantType;
use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;

class MijnEersteController extends Controller
{

	/**
	 * @Route("/klant/nieuw", name="klantnieuw")
	 */
	public function nieuweKlant(Request $request) {
	$nieuweKlant = new Klant();
	$form = $this->createForm(KlantType::class, $nieuweKlant);

	$form->handleRequest($request);
	if ($form->isSubmitted() && $form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		$em->persist($nieuweKlant);
		$em->flush();
		return $this->redirect($this->generateurl.("klantnieuw"));
		}
		return new Response($this->render('form.html.twig', array('form' => $form->createView())));
	}

	/**
	 * @Route("/klant/wijzig/{klantnummer}", name="klantwijzigen")
	 */
	public function wijzigKlant(Request $request, $klantnummer) {
	$bestaandeKlant = $this->GetDoctrine()->getRepository("AppBundle:Klant")->find($klantnummer);
	$form = $this->createForm(KlantType::class, $bestaandeKlant);

	$form->handleRequest($request);
	if ($form->isSubmitted() && $form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		$em->persist($bestaandeKlant);
		$em->flush();
		return $this->redirect($this->generateurl.("Alleklanten"));
		}
		return new Response($this->render('form.html.twig', array('form' => $form->createView())));
	}

	/**
	 * @Route("/product/nieuw", name="nieuwproduct")
	 */
	public function nieuwProduct(Request $request) {
		$nieuwProduct = new Product();
		$form = $this->createForm(ProductType::class, $nieuwProduct);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($nieuwProduct);
			$em->flush();
			return $this->redirect($this->generateurl.("nieuwproduct"));
		}

		return new Response($this->render('form.html.twig', array('form' => $form->createView())));
	}

	/**
	 * @Route("/product/wijzig/{barcode}", name="productwijzigen")
	 */
	public function wijzigProduct(Request $request, $barcode) {
		$bestaandProduct = $this->getDoctrine()->getRepository("AppBundle:Klant")->find($barcode);
		$form = $this->createForm(ProductType::class, $bestaandProduct);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($bestaandProduct);
			$em->flush();
			return $this->redirect($this->generateurl.("productwijzigen"));
		}

		return new Response($this->render('form.html.twig', array('form' => $form->createView())));
	}


	/**
	* @Route("/hallo/wereld", name="hallo_wereld")
	*/
	public function halloWereld() {
		return new Response("Hallo wereld ik ben een Symfony applicatie!");
	}

	/**
	* @Route("/alle/Klanten", name="alle_Klanten")
	*/

public function alleKlanten(Request $request) {
	$klanten = $this->GetDoctrine()->getRepository("AppBundle:Klant")->findAll();
	$tekst = "";
	foreach($klanten as $klant){
  $tekst = $tekst . $klant->getVoornaam() . $klant->getAchternaam() . $klant->getTelefoonnummer() . "<br />";
}

return new Response($tekst);
}

/**
* @Route("/klanten/{voornaam}", name="klantopvoornaam")
*/
public function klantOpVoornaam(Request $request, $voornaam) {
	$klanten = $this->GetDoctrine()->getRepository("AppBundle:Klant")->findByVoornaam($voornaam);
	$tekst = "";
	foreach($klanten as $klant){
			$tekst = $tekst . $klant->getVoornaam() . " " . $klant->getAchternaam() . " " . $klant->getTelefoonnummer() . "<br />";
			}

		return new Response($tekst);
		}

		/**
		* @Route("/klanten/opwoonplaats/{woonplaats}", name="klantopwoonplaats")
		*/
		public function klantOpWoonplaats(Request $request, $woonplaats) {
			$klanten = $this->GetDoctrine()->getRepository("AppBundle:Klant")->findByWoonplaats($woonplaats);
			$tekst = "";
			foreach($klanten as $klant){
					$tekst = $tekst . $klant->getVoornaam() . " " . $klant->getAchternaam() . " " . $klant->getTelefoonnummer() . "<br />";
					}

				return new Response($tekst);
				}
}
