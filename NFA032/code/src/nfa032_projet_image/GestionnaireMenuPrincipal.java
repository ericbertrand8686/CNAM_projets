package nfa032_projet_image;

//---------------------------------------------------------------------------------------
//Rubriques du menu qui implémentent l'interface RubriqueAvecDeclenchementAction
//Les éléments suivant affichent leur titre et exécutent l'action qui leur correspond
//---------------------------------------------------------------------------------------


public class GestionnaireMenuPrincipal {
	
	public boolean siContinuer = true;									// utilisé dans la boucle principale de main() pour rester ou sortir de la boucle
		private ListeImages imagesProjet = new ListeImages();				// On crée la liste des images
		public RubriquesDuMenuPrincipal rubriquesProjet = new RubriquesDuMenuPrincipal();
						

	public class RubriquesDuMenuPrincipal {
		
		public class MenuPrincipalProjet implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			
			private Menu menuPrincipal = new Menu(new RubriquePourSelectionDansMenu [] {
					rubriquesProjet.new LireFichier(),
					rubriquesProjet.new EnregistreFichier(),
					rubriquesProjet.new AfficherListeImages(),
					rubriquesProjet.new ModifierImage(),
					rubriquesProjet.new ModificationRecursiveImage(),
					rubriquesProjet.new RecadrerImage(),
					rubriquesProjet.new RedimensionnerImage(),
					rubriquesProjet.new ModificationDansRectangle(),
					rubriquesProjet.new IncrustationImages(),
					rubriquesProjet.new Quitter()
					});
			
			public String getTitre() { 
				return("Menu Principal");
				}

			public void declenche() {
				RubriquePourSelectionDansMenu rubriqueChoisie;
				
				Terminal.ecrireStringln(this.getTitre());
				Terminal.ecrireStringln("");
				
				rubriqueChoisie = this.menuPrincipal.choisir();
				if (rubriqueChoisie==null) return;
				
				((RubriqueAvecDeclenchementAction) rubriqueChoisie).declenche();
			}
		}

		//---------------------------------------------------------------------------------------
		private class LireFichier implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			public String getTitre() {
				return("Lire un nouveau fichier");
				}
			
			public void declenche() {
				
				if (!imagesProjet.placeDisponible()) {
					Terminal.ecrireStringln("Plus de place pour charger un fichier");
					Terminal.ecrireStringln("");
					return;
				}
				
				Terminal.ecrireString("Entrez le nom du fichier à charger : ");
				String nomFichier = Terminal.lireString();
				
				imagesProjet.disponible().chargerFichier (imagesProjet.repertoire(), nomFichier);
				Terminal.ecrireStringln("");
				}
		}
		
		
		//---------------------------------------------------------------------------------------
		private class EnregistreFichier implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			public String getTitre() {
				return("Enregistrer un fichier");
				}
			
			public void declenche() {

				Terminal.ecrireString ("Entrez le numéro de l'image à sauvegarder : " );
				ImagePPM imageCourante = imagesProjet.choixImage();
				Terminal.ecrireStringln ("");
				if (imageCourante==null) return;
				
				Terminal.ecrireString("Entrez le nom du fichier à enregistrer : " );
				String nomFichier = Terminal.lireString();
				//Terminal.ecrireStringln ("");
				
				imageCourante.enregistrerFichier (imagesProjet.repertoire(), nomFichier);
				Terminal.ecrireStringln("Le fichier à bien été sauvegardé");
				Terminal.ecrireStringln("");
			}		
		}
		
		
		//---------------------------------------------------------------------------------------
		private class AfficherListeImages implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			public String getTitre() {
				return("Afficher la liste des images en mémoire");
				}
			public void declenche() {
				Terminal.ecrireStringln("La liste des images en mémoire est :");
				imagesProjet.afficheListe();
			}
		}
		
		//---------------------------------------------------------------------------------------
		private class ModifierImage implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			
			private Menu modificationsGlobales = new Menu(new RubriquePourSelectionDansMenu [] {
					new Segment.Modification.Moyenne(),
					new Segment.Modification.Negatif(),
					new Segment.Modification.Foncer(),
					new Segment.Modification.FoncerParIntervalle()
					});
			
			public String getTitre() { 
				return("Modifications de toute l'image");
				}

			public void declenche() {
				RubriquePourSelectionDansMenu rubriqueChoisie;
				
				Terminal.ecrireString ("Entrez le numéro de l'image à modifer : " );
				ImagePPM imageCourante = imagesProjet.choixImage();
				Terminal.ecrireString("");
				if (imageCourante==null) return;
				
				Terminal.ecrireStringln("Choisissez un type de modification");
				rubriqueChoisie = this.modificationsGlobales.choisir();
				if (rubriqueChoisie==null) return;
				
				// Dans certains cas comme Negatif la transformation a besoin des paramètres de l'image courante
				Segment.Modification.transfereParametresImage(imageCourante);
				// On rentre les paramètres manuels de la transformation si c'est nécessaire
				((ModificationSegment) rubriqueChoisie).menuParametresManuel();
				
				imageCourante.modificationGlobale((ModificationSegment) rubriqueChoisie);
				
				Terminal.ecrireStringln("L'opération a été effectuée sur toute l'image");
				Terminal.ecrireStringln("");
			}
		}
		
		
		//---------------------------------------------------------------------------------------
private class ModificationRecursiveImage implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			
			private Menu modificationsRecursives = new Menu(new RubriquePourSelectionDansMenu [] {
					new Segment.Modification.Moyenne(),
					new Segment.Modification.Negatif(),
					new Segment.Modification.Foncer(),
					});
			
			public String getTitre() { 
				return("Modifications de toute l'image par une méthode récursive");
				}

			public void declenche() {
				RubriquePourSelectionDansMenu rubriqueChoisie;
				
				Terminal.ecrireString ("Entrez le numéro de l'image à modifer : " );
				ImagePPM imageCourante = imagesProjet.choixImage();
				Terminal.ecrireString("");
				if (imageCourante==null) return;
				
				Terminal.ecrireStringln("Choisissez un type de modification");
				rubriqueChoisie = this.modificationsRecursives.choisir();
				if (rubriqueChoisie==null) return;
				
				// Dans certains cas comme Negatif la transformation a besoin des paramètres de l'image courante
				Segment.Modification.transfereParametresImage(imageCourante);
				// On rentre les paramètres manuels de la transformation si c'est nécessaire
				((ModificationSegment) rubriqueChoisie).menuParametresManuel();
				
				imageCourante.modificationGlobaleRecursive((ModificationSegment) rubriqueChoisie);
				
				Terminal.ecrireStringln("L'opération a été effectuée sur toute l'image");
				Terminal.ecrireStringln("");
			}
		}


		//---------------------------------------------------------------------------------------
		private class RecadrerImage implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			public String getTitre() { 
				return("Recadrer une image (crop)");
				}
			
			public void declenche() {			
				Terminal.ecrireString ("Entrez le numéro de l'image à recadrer : " );
				ImagePPM imageCourante = imagesProjet.choixImage();
				Terminal.ecrireStringln("");
				if (imageCourante==null) return;
				
				Terminal.ecrireString ("Vous avez selectionné : ");
				imageCourante.afficheDansListe();
				Terminal.ecrireStringln("");
							
				ZoneRectangulaire rectangleCourant = imageCourante.selectionneZoneRectangulaire();
				imageCourante.recadre(rectangleCourant);
				
				Terminal.ecrireStringln("");
				Terminal.ecrireStringln("L'image a été recadrée");
				Terminal.ecrireStringln("");
			
			}
		}
		
		//---------------------------------------------------------------------------------------
		private class RedimensionnerImage implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
		
			private int nouvelleLargeur, nouvelleHauteur;
			
			public String getTitre() {
				return("Redimensionner une des images en mémoire");
				}
			
			public void declenche() {
				Terminal.ecrireString ("Entrez le numéro de l'image à redimensionner : " );
				ImagePPM imageCourante = imagesProjet.choixImage();
				Terminal.ecrireStringln("");
				if (imageCourante==null) return;
				
				Terminal.ecrireString ("Entrez la nouvelle largeur de l'image : " );
				nouvelleLargeur  = Terminal.lireInt();
				Terminal.ecrireString ("Entrez la nouvelle longueur de l'image : " );
				nouvelleHauteur = Terminal.lireInt();
				Terminal.ecrireStringln("");
				
				imageCourante.redimensionne(nouvelleLargeur,nouvelleHauteur);
				
				Terminal.ecrireStringln("L'image a été redimensionnée");
				Terminal.ecrireStringln("");
				}
		}

		//---------------------------------------------------------------------------------------
		private class ModificationDansRectangle implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			
			private Menu modificationsRectangle = new Menu(new RubriquePourSelectionDansMenu [] {
					new Segment.Modification.MonochromeCouleurElementaire(new Segment.Rouge()),
					new Segment.Modification.MonochromeCouleurElementaire (new Segment.Vert()),
					new Segment.Modification.MonochromeCouleurElementaire(new Segment.Bleu()),
					new Segment.Modification.Moyenne()});
				
			public String getTitre() {
				return("Modifications dans une zone rectangulaire de l'image");
				}
		
			public void declenche() {			
				RubriquePourSelectionDansMenu rubriqueChoisie;
				
				Terminal.ecrireString ("Entrez le numéro de l'image à modifer : " );
				ImagePPM imageCourante = imagesProjet.choixImage();
				Terminal.ecrireStringln("");
				if (imageCourante==null) return;
				
				Terminal.ecrireStringln("Choisissez un type de modification");
				rubriqueChoisie = this.modificationsRectangle.choisir();
				if (rubriqueChoisie==null) return;
				
				Segment.Modification.transfereParametresImage(imageCourante);
				((ModificationSegment) rubriqueChoisie).menuParametresManuel();
				
				Terminal.ecrireStringln("Définissez la zone rectangulaire à modifier");
				ZoneRectangulaire rectangleCourant = imageCourante.selectionneZoneRectangulaire();
				imageCourante.modificationDansRectangle(rectangleCourant, (ModificationSegment) rubriqueChoisie);
				
				Terminal.ecrireStringln("");
				Terminal.ecrireStringln("La zone rectangulaire a été modifiéé");
				Terminal.ecrireStringln("");			
			}
		}

		//---------------------------------------------------------------------------------------
		private class IncrustationImages implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			public String getTitre() { 
				return("Incrustation d'une image dans l'autre");
				}
			public void declenche() {
				
				Terminal.ecrireString ("Entrez le numéro de l'image qui sert de fond : " );
				ImagePPM imageFond = imagesProjet.choixImage();
				Terminal.ecrireString("");
				if (imageFond==null) return;
				
				Terminal.ecrireString ("Entrez le numéro de l'image qui va être incrustée : " );
				ImagePPM imageIncrustee = imagesProjet.choixImage();
				Terminal.ecrireString("");
				if (imageIncrustee==null) return;
								
				imageFond.incrustation(imageIncrustee);
				
				Terminal.ecrireStringln("");
				Terminal.ecrireStringln("L'incrustation a été effectuée (Fonction non finalisée)");
				Terminal.ecrireStringln("");
			}
		}
		
		
		private class Quitter implements RubriqueAvecDeclenchementAction, RubriquePourSelectionDansMenu {
			
			public String getTitre() { 
				return( "Quitter le programme");
				}
			
			public void declenche() {
				Terminal.ecrireStringln("Au revoir");
				Terminal.ecrireStringln("");
				siContinuer = false;
			}
		}
	}
	

}
