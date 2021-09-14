/*******************************************************************/
/* Projet 2                                                        */
/* Etape 3 : synchronisation en utilisant deux Mutex               */
/*******************************************************************/
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <pthread.h>

char message[100];

pthread_mutex_t droit_ecriture;
pthread_mutex_t droit_lecture;

/***********************************/
/* THREAD SECONDAIRE */
/***********************************/
static void *code_thread_sec (void* arg) {

    pthread_t pthrmoi;  // identification Posix du thread
    pthrmoi = pthread_self();
    
    while(1) {
        if (1) {
            pthread_mutex_lock (&droit_lecture);
            printf( "<thread : %u > : <message : %s >\n", (unsigned int)pthrmoi, message);
            pthread_mutex_unlock (&droit_ecriture);
        }
    } // Boucle sans Fin
}

/***********************************/
/* PROCESSUS ET THREAD PRINCIPAL   */
/***********************************/
int main() {

    pthread_t pthrmain, pthrsec;
    pthrmain = pthread_self();

    // Initialisation des Mutex, on ouvre l'écriture et on ferme la lecture
    pthread_mutex_init (&droit_ecriture, NULL);
    pthread_mutex_init (&droit_lecture, NULL);
    pthread_mutex_unlock (&droit_ecriture);
    pthread_mutex_lock (&droit_lecture);

    // Creation du thread secondaire
    if (pthread_create(&pthrsec, NULL,&code_thread_sec, NULL) != 0)
        printf( "\nJe suis le thread principal Posix %u, faute lancement du thread secondaire\n\n", (unsigned int)pthrmain);
    else printf( "\nJe suis le thread principal Posix %u et j'ai lancé le thread secondaire Posix %u \n\n", (unsigned int)pthrmain, (unsigned int)pthrsec);

    while(1) {
        pthread_mutex_lock (&droit_ecriture);
        printf("<thread : %u > : Veuillez saisir un message\n", (unsigned int)pthrmain);
        fgets (message,100,stdin);
        message[strcspn(message, "\r\n")] = 0; // On tronque le message au niveau du passage à la ligne
        pthread_mutex_unlock (&droit_lecture);
    }
}
