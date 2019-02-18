SELECT COUNT(*) as nb FROM conducteur;
SELECT COUNT(*) as nb FROM vehicule;
SELECT COUNT(*) as nb FROM association_vehicule_conducteur;

SELECT vehicule.id_vehicule, marque, modele, couleur, immatriculation
FROM vehicule
LEFT JOIN association_vehicule_conducteur
    ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule
WHERE id_conducteur IS NULL;

SELECT conducteur.id_conducteur, prenom, nom
FROM conducteur
LEFT JOIN association_vehicule_conducteur
    ON association_vehicule_conducteur.id_conducteur = conducteur.id_conducteur
WHERE id_vehicule IS NULL;

SELECT vehicule.id_vehicule, marque, modele, couleur, immatriculation
FROM vehicule
INNER JOIN association_vehicule_conducteur
    ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule
INNER JOIN conducteur
    ON conducteur.id_conducteur = association_vehicule_conducteur.id_conducteur
WHERE prenom = 'Philippe'
AND nom = 'Pandre';

SELECT modele, prenom
FROM conducteur
LEFT JOIN association_vehicule_conducteur
    ON association_vehicule_conducteur.id_conducteur = conducteur.id_conducteur
LEFT JOIN vehicule
    ON	vehicule.id_vehicule = association_vehicule_conducteur.id_vehicule;

SELECT modele, prenom
FROM vehicule
LEFT JOIN association_vehicule_conducteur
    ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule
LEFT JOIN conducteur
    ON	conducteur.id_conducteur = association_vehicule_conducteur.id_conducteur;

SELECT modele, prenom
FROM conducteur
LEFT JOIN association_vehicule_conducteur
    ON association_vehicule_conducteur.id_conducteur = conducteur.id_conducteur
LEFT JOIN vehicule
    ON	vehicule.id_vehicule = association_vehicule_conducteur.id_vehicule
    
UNION

SELECT modele, prenom
FROM vehicule
LEFT JOIN association_vehicule_conducteur
    ON association_vehicule_conducteur.id_vehicule = vehicule.id_vehicule
LEFT JOIN conducteur
    ON	conducteur.id_conducteur = association_vehicule_conducteur.id_conducteur;