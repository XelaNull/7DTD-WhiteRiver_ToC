* Its been so long, I dont even remember the flow of all the quests
* Share screenshot of other quests on the back-burner
* Who is "7DaystoDie.JP"? Noted in the ModInfo.xmls of the Mods in the pack (what was the provenance of the source code they used to modify)
* Interesting note: In terms of the first letter of each mod, we have more than 50% of the letters of the alphabet

### 7DTD v1.0 White River Tools of Citizenship, Core Citizenship Modlet Rewrite


THE PROBLEM:
* We don't have custom dialog that we can trigger for a wholly trader-based chat dialog for quest management.
* We don't have any sort of "UI" that shows the player all of the different quests that are possible with their citizenship.
* Basing citizenship into a society on the number of zombie kills in a world where everyone is killing zombies does not seem particularly fitting and would have no basis for being tracked by the society. (Realism)

THE CHALLENGE:
Rewrite the "required" core modlet for the tools of citizenship and re-think the new player experience, resulting in something that better meshes with the vanilla experience while also not requiring a major rewrite of the quest management across all the quests in the pack. Minimize resource loopholes that would otherwise allow a player to cheat through starting multiple consecutive low-effort tasks.

ANALYSIS OF BUILT-IN QUEST SYSTEM:
TFP added a trader-based quest system some time ago and chose to go with a tiering structure that only unlocks after you've completed a certain number of quests in the previous tier. On the surface this seems like a good match with ToC until you consider that the quests that are offered up by the trader are basically random. This wholly removes the control the player currently has over taking on exactly whatever ToC quest they want at a specific time. It is because of this that this modlet pack does not base its quest system on the built-in TFP quest system.

=-=-=-=-=-=-=-=-=-=-=-=

TFP has added a Challenges window that in the base game that has a new player go through a set of initial tasks (challenges) to collect or craft an item. It also is used to track whether the player has located each trader and other collection and crafting related accomplishments. The challenges window has normally three tabs to it for Basic, Advanced, and Twitter. I've proven out creating an extra tab to this page that would provide an entire page of challenges to the player representing the White River Tools of Citizenship quests that are loaded on the server. This would allow the quests within the pack to visually be presented to the player, and provides a larger UI for initial quest text enticing them to take on each quest.

If we span a 12 quests across two challenge groups (maybe 7 in one, 5 in the other), both challenge groups could unlock at the same time both using a singular challengegroup to unlock it. The final challenge in the second challengegroup is what completes the tier. The completion of that challengegroup specifically would be used as the trigger to unlock the next tier's challengegroup. Through this methodology, we could set it up so that a single tier of quests within the modpack span across two challengegroups. The only issue we could run into is in rare situations where a server operator chooses to run so few modlets from the pack that there would be no entries  for a challengegroup. In a case like this, players would get stuck unable to progress through the tiers of ToC. But the upside is visually spanning the tier across two challengegroups would fill in the page more vertically and also ensure there is room for growth into the future.

=-=-=-=-=-=-=-=-=-=

At end of "Journey to the Settlement" quest there is a "Talk to the Trader" step. In it the final rewards popup has text:

    "Noah sent you eh? We have a variety of types of challenging quests for you. You can either talk to me for some simple quests or if you are interested in actually contributing around here, read over this +Declaration of Citizenship. Take this shovel and move along.
+ Declaration of Citizenship, which is ingredient to start any basic-tier quest"


    1. Completion of the "Basic" challenge group also opens up the ToC Basic Quests from the Challenge window.
    2. Claiming each challenge reward obtains the ToC quest starter item and gives you citizen card back upon successful completion of the quest.
    3. Completing a challenge grants you a Basic tier ToC completion token.
    4. The last challenge of the basic tier challenge is to obtain ___ number of basic tier completion tokens & then use them to craft the veteran citizenship card. This completes the Basic ToC challengegroup and unlocks the Veteran ToC challengegroup.
    5. Claiming each challenge reward obtains the ToC quest starter item and gives you veteran citizen card back upon successful completion of the quest.
    6. Completing a challenge grants you a Veteran tier ToC completion token.
    7. The last challenge of the veteran tier challenge is to obtain ___ number of veteran tier completion tokens & then use them to craft the elite citizenship card. This completes the Veteran ToC challengegroup and unlocks the Elite ToC challengroup.
    8. Claiming each challenge reward obtains the ToC quest starter item and gives you elite citizen card back upon successful completion of the quest.

=-=-=-=-=-=-=-=-=-=-

The declaration of citizenship card can be crafted from a piece of paper and is the only ingredient to craft quest starter item for any of the Initiate level quests.
Each completed quest rewards a completion token for either Initiate, Citizen, or Veteran. Elite quests don't need to return completion token as there is no larger tier.
Completion tokens are used to craft the citizenship card for the next tier up. 


##### White River Initiate (Declaration of Citizenship)

Challenge Tier 1:
- Taza's Axe (Initiate) (New Quest Tier) 
    Short tag: Prove your worth as a citizen, obtain an axe.
    Long: [DECEA3]Gather[-] an amount of small stone.\n\n[DECEA3]Craft[-] a handful of stone axes.\n\nIn exchange for your hard work you'll [DECEA3]receive[-] an Initiate Taza axe, which is a replica of the famous Taza Axe.\n\nA solid axe will become the primary [DECEA3]tool of your citizenship[-].
- Dundee's Knife (Initiate) (New Quest Tier) 
    Short tag: Prove your worth as a citizen, obtain a knife. 
    Long: Help prove that you can be of help to the White River community as a citizen, by [DECEA3]crafting some bone knives[-]. In exchange for your help, you'll [DECEA3]receive a shoddily-made Dundee knife[-].\n\nOne stepping-stone along the path towards citizenship.
- Jason's Machete (Moved Quest)
    Short tag: Prove your worth as a citizen, obtain a machete.
    Long: The flower is more powerful than the sword...or machete.\n\n[DECEA3]Collect[-] a lot of flowers to warm the Trader's heart and [DECEA3]obtain a machete[-] with the name JASON carved into the handle.
- Brass For Lead (Moved Quest) 
    Short tag: Help stock the community's lead supply.
    Long: The White River community is always short on lead for bullet making.\n\n[DECEA3]Provide lead[-] to help stock the community's stores and [DECEA3]receive brass[-] in exchange for your hard work. The community is always short on lead, so this quest can be repeated.
- Bear Grylls's Iron Knuckles (Moved Quest) 
    Short tag: Kill a bear in hand-to-hand combat.
    Long: Nothing says demonstrating how much of a bad ass you are, like taking on a bear in [DECEA3]hand-to-hand[-] combat. [DECEA3]Kill a bear[-] while wearing knuckles and [DECEA3]obtain[-] a quality set of iron knuckles.
+ Craft White River Citizen Card
    Short tag: You did it! Craft your White River Citizen Card
    Long tag: Now that you have saved up enough question completion tokens, [DECEA3]craft a White River Citizen Card[-] from your completion tokens. [DECEA3]Become a full White River Citizen[-] and continue amassing your collection of citizenry tools.

##### White River Citizen Card

Challenge Tier 1:
- Taza's Axe (Citizen)
    Short tag: Help your community, and obtain a better Taza's axe.
    Long: [DECEA3]Gather[-] an amount of small stone.\n\n[DECEA3]Craft[-] a handful of stone axes.\n\nIn exchange for your hard work you'll [DECEA3]receive[-] a fabled Taza axe, which is a replica of the famous Taza Axe.\n\nA solid axe will become the primary [DECEA3]tool of your citizenship[-].
- Dundee's Knife (Citizen) 
    Short tag: Help your community, and obtain a better Dundee branded knife.
    Long: Help prove that you can be of help to the White River community as a citizen, by [DECEA3]crafting some bone knives[-].\n\nIn exchange for your help, you'll [DECEA3]receive a high quality Dundee knife[-].
- Bambi's Compound Bow
    Short tag: Help your community, and obtain a compound bow.
    Long: [DECEA3]Obtain some bow parts[-] for the Trader and [DECEA3]obtain a quality compound bow[-] for your efforts.\n\nThis will make a fine addition to your [DECEA3]t[-]ools [DECEA3]o[-]f [DECEA3]c[-]itizenship.
- Everdeen's Arrows
    Short tag: Stock your quiver by stocking your community's kitchen.
    Long: The White River community's kitchen seems always bare these days. As a full-fledged citizen it is now your responsibility to help keep them stocked.\n\nHelp [DECEA3]locate some food[-] and in exchange [DECEA3]receive some quality arrows[-].
- Everdeen's Bolts 
    Short tag: Stock your quiver by stocking your community's kitchen.
    Long: The White River community's kitchen seems always bare these days. As a full-fledged citizen it is now your responsibility to help keep them stocked.\n\nHelp [DECEA3]locate some food[-] and in exchange [DECEA3]receive some quality crossbow bolts[-].
- Bear Grylls's Iron Knuckles (Moved Quest) 
    Short tag: Prove your worth in bear hand-to-hand combat.
    Long: Time to double-down on how much of a bda ass you are. This time you'll be taking on [DECEA3]multiple bears in hand-to-hand combat[-]. Prove your worth and [DECEA3]obtain a quality steel knuckles[-].

Challenge Tier 2: (Both Challenge Tiers Unlock Same Time)
- Bunyan's FireAxe 
    Short tag: Fell 50 trees at a time with a Bunyan axe.
    Long: No handheld axe fells trees faster than Bunyan's FireAxe. Rumored to once have been used to fell 50 trees in a single swing.\n\nHelp [DECEA3]stock the community's food stores[-] through [DECEA3]obtaining bottled water[-].
- Leon's SMG 
    Short tag: Help Leon with his DIY project, obtain an SMG.
    Long: [DECEA3]Help Leon[-] with his latest DIY projects to [DECEA3]obtain a working SMG[-].
- Kuva's Armor 
    Short tag: Recover the recipe for Kuva's armor.
    Long: 
- Deschain's Revolver 
    Short tag: Find 8 books, Craft 10 Doors, obtain a lightning fast revolver.
    Long: 
+ Craft Veteran Citizen Card

##### White River Veteran Citizen Card (Veteran Challenge Tiers Unlock upon Completion of White River Citizen Card Challenge Tier 2)

Challenge Tier 1:
- Taza's Axe (Veteran) 
    Short tag: Show substantial support and obtain the best quality Taza's axe.
    Long: [DECEA3]Gather[-] an amount of small stone.\n\n[DECEA3]Craft[-] a handful of stone axes.\n\nIn exchange for your hard work you'll [DECEA3]receive[-] the fabled Taza axe.\n\nThis famous axe will become the primary [DECEA3]tool of your citizenship[-].
- Rick Danger Auger 
    Short tag: Recover the plans for an experimental auger.
    Long: 
- BlackBart's Dig Tools 
    Short tag: Dig deep to discover real treasure.
    Long: 
- Bambi's Compound Bow 
    Short tag: Obtain a better quality Bambi's Compound bow.
    Long: 
- Leon's SMG 
    Short tag: Help Leon with the next generation of SMG.
    Long: 
- Kuva's Armor 
    Short tag: Recover the recipe for Kuva's armor.
    Long: 
Challenge Tier 2: (Both Challenge Tiers Unlock Same Time)
- Daryl's Compound Crossbow 
    Short tag: Work hard and obtain a zombie-killing compound crossbow.
    Long: 
- Pavlichenko's Rifle 
    Short tag: Build your own Pavlichenko rifle.
    Long: 
- Molino Bulletproof Glass Blocks 
    Short tag: Obtain some bulletproof glass blocks.
    Long: 
- Gupta's Bandages (Moved Quest)
    Short tag: Craft heal-over-time bandages.
    Long: 
- Amelia Earhart's Gyrocopter 
    Short tag: Discover what happened to Amelia Earhart.
    Long: 
+ Craft Elite Citizen Card

##### White River Elite Citizen Card (Elite Challenge Tiers Unlock upon Completion of White River Veteran Citizen Card Challenge Tier 2)

Challenge Tier 1:
- Spirit of Vengeance
    Short tag: Take on minions from hell.
    Long: 
- Rick Danger Auger 
    Short tag: Recover the plans for an experimental auger.
    Long: 
- Remington's Steel Ammo 
    Short tag: Discover how to craft steel ammo.
    Long: 
- Daryl's Crossbow 
    Short tag: Obtain the ultimately zombie-killing compound crossbow.
    Long: 
- Bambi's Compound Bow 
    Short tag: Obtain a top-tier compound bow.
    Long: 
- Molino Bulletproof Glass Recipe 
    Short tag: Learn how to craft bulletproof glass blocks.
    Long: 