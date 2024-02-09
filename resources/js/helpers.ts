import { CharacterBanner } from "./models";

export function getCharacterBannerName(banner: CharacterBanner) {
    if(banner.name) return banner.name;

    let featured_five_star = banner.featured.find(f => f.rarity == 5);
    if(featured_five_star) {
        return featured_five_star.featured_name? featured_five_star.featured_name : 'No name'
    }
    return 'No name';
}