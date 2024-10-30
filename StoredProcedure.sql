CREATE procedure p_artikel_hinzufuegen(Artikelnummer INTEGER, Stückzahl INTEGER, Preis DECIMAL(10, 2))
BEGIN
    DECLARE aid INTEGER;
    SELECT MAX(id)
    INTO aid
    FROM t_lager
    WHERE Artikelnummer = id_artikel;
    IF aid IS NOT NULL THEN
        -- Update if a record with the given Artikelnummer already exists
        UPDATE t_lager
        SET stueck     = Stückzahl,
            preis      = Preis,
            id_artikel = Artikelnummer
        WHERE id = aid;
    ELSE
        -- Insert a new record if no such Artikelnummer exists
        INSERT INTO t_lager (stueck, preis, id_artikel)
        VALUES (Stückzahl, Preis, Artikelnummer);
    END IF;
END