export class Character {
    id!: number;
    name!: string;
    rarity!: number;
    weapon_type!: WeaponType;
    element!: Element;
    featured_name?: string;
    last_banner?: CharacterBanner;
    banners?: CharacterBanner[];
}

export class Weapon {
    id!: number;
    name!: string;
    rarity!: number;
    weapon_type!: WeaponType;
    last_banner?: WeaponBanner;
    banners?: WeaponBanner[];
}

export enum WeaponType {
    BOW = 0,
    CATALYST,
    CLAYMORE,
    POLEARM,
    SWORD,
}

export const weaponSelectOptions: any = [
    {
        value: WeaponType.BOW,
        title: WeaponType[WeaponType.BOW],
    },
    {
        value: WeaponType.CATALYST,
        title: WeaponType[WeaponType.CATALYST],
    },
    {
        value: WeaponType.CLAYMORE,
        title: WeaponType[WeaponType.CLAYMORE],
    },
    {
        value: WeaponType.POLEARM,
        title: WeaponType[WeaponType.POLEARM],
    },
    {
        value: WeaponType.SWORD,
        title: WeaponType[WeaponType.SWORD],
    },
];


export enum Element {
    GEO = 0,
    ANEMO,
    PYRO,
    ELECTRO,
    CRYO,
    DENDRO,
    HYDRO,
}

export const elementSelectOptions: any = [
    {
        value: Element.GEO,
        title: Element[Element.GEO],
    },
    {
        value: Element.ANEMO,
        title: Element[Element.ANEMO],
    },
    {
        value: Element.PYRO,
        title: Element[Element.PYRO],
    },
    {
        value: Element.ELECTRO,
        title: Element[Element.ELECTRO],
    },
    {
        value: Element.CRYO,
        title: Element[Element.CRYO],
    },
    {
        value: Element.DENDRO,
        title: Element[Element.DENDRO],
    },
    {
        value: Element.HYDRO,
        title: Element[Element.HYDRO],
    }
];

export class CharacterBanner {
    id!: number;
    name!: string;
    patch!: string;
    featured!: Character[];
    start_date!: Date;
    end_date!: Date;
}

export class WeaponBanner {
    id!: number;
    name!: string;
    patch!: string;
    featured!: Weapon[];
    start_date!: Date;
    end_date!: Date;
}