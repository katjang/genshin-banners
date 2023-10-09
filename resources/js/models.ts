export class Character {
    id!: number;
    name!: string;
    rarity!: number;
    type!: WeaponType;
    last_banner?: Banner;
}

export enum WeaponType {
    BOW,
    CATALYST,
    CLAYMORE,
    POLEARM,
    SWORD,
}

export class Banner {
    id!: number;
    name!: string;
    characters!: Character[];
    start_date!: Date;
    end_date!: Date;
}