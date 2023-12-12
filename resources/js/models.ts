export class Character {
    id!: number;
    name!: string;
    rarity!: number;
    weapon_type!: WeaponType;
    element!: Element;
    last_banner?: Banner;
    banners?: Banner[];
}

export enum WeaponType {
    BOW = 0,
    CATALYST,
    CLAYMORE,
    POLEARM,
    SWORD,
}

export enum Element {
    GEO = 0,
    ANEMO,
    PYRO,
    ELECTRO,
    CRYO,
    DENDRO,
    HYDRO,
}

export class Banner {
    id!: number;
    name!: string;
    patch!: string;
    featured?: Character[];
    start_date!: Date;
    end_date!: Date;
}