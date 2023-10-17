import AuthenticatedLayout from "@/Layouts/StudentAuthenticatedLayout";
import {Head} from "@inertiajs/react";
import {PageProps} from "@/types";
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "@/Components/ui/card";
import {
    DotsHorizontalIcon,
    DownloadIcon,
    UploadIcon,
    TrashIcon,
} from "@radix-ui/react-icons";
import {
    ListTile,
    ListTileContent,
    ListTileDescription,
    ListTileLeading,
    ListTileTitle,
    ListTileTrailing
} from "@/Components/list-tile";
import {Button} from "@/Components/ui/button";
import {Avatar, AvatarFallback, AvatarImage} from "@/Components/ui/avatar";
import {PlusIcon} from "@heroicons/react/24/solid";
import {Popover, PopoverContent, PopoverTrigger} from "@/Components/ui/popover";
import {ChevronDownIcon} from "@heroicons/react/20/solid";
import {Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList} from "@/Components/ui/command";
import {MessageSquareIcon} from "lucide-react";
import ConfirmButton from "@/Components/confirm-button";

export default function Dashboard({auth}: PageProps) {
    const members = [
        {
            id: 1,
            avatar: "JD",
            name: "John Doe (YOU)",
            email: "bscs1234@szabist.pk"
        },
        {
            id: 2,
            avatar: "JS",
            name: "John Smith",
            email: "bscs1234@szabist.pk"
        }
    ];
    const files = [
        {
            id: 1,
            name: "SRS Zabdesk.pdf",
        },
        {
            id: 2,
            name: "System Flow Diagram.jpg",
        }
    ]
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    View Project | Zabdesk
                </h2>
            }
        >
            <Head title="Viewing Project | Zabdesk"/>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <Card className="md:col-span-2">
                    <CardHeader>
                        <CardTitle>Zabdesk</CardTitle>
                        <CardDescription>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas rhoncus, ligula sed
                            semper consectetur, purus enim cursus justo, et pretium neque nunc vitae lacus. Nam sit amet
                            elementum libero, eu posuere lorem. Pellentesque felis ex, varius ac commodo sed, ornare
                            et lectus. Proin eget velit a metus porttitor pretium. Quisque sollicitudin nisl justo, et
                            pharetra ligula semper sit amet. Morbi vel risus eu magna lobortis congue facilisis at
                            arcu.
                            Nullam auctor massa id sagittis sodales. Curabitur ultricies arcu sed nunc tincidunt,
                            quis convallis magna interdum. Donec ac nunc posuere, auctor leo id, pulvinar lorem. Orci
                            varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        </CardDescription>
                    </CardHeader>
                </Card>
                <div className="space-y-4">
                    <Card>
                        <CardHeader>
                            <CardTitle>Advisor</CardTitle>
                            {/*<CardDescription>Ali Mobin</CardDescription>*/}
                        </CardHeader>
                        <CardContent>
                            <div className="flex items-center justify-between space-x-4">
                                <div className="flex items-center space-x-4">
                                    <Avatar>
                                        <AvatarFallback>AM</AvatarFallback>
                                    </Avatar>
                                    <div>
                                        <p className="text-sm font-medium leading-none">Ali Mobin</p>
                                    </div>
                                </div>
                                <Button variant="outline" size="icon">
                                    <MessageSquareIcon className="h-4 w-4"/>
                                </Button>
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle>Team Members</CardTitle>
                            <CardDescription>
                                Invite your team members to collaborate.
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="grid gap-6">
                            {members.map((member) => (
                                <div key={member.id} className="flex items-center justify-between space-x-4">
                                    <div className="flex items-center space-x-4">
                                        <Avatar>
                                            <AvatarFallback>{member.avatar}</AvatarFallback>
                                        </Avatar>
                                        <div>
                                            <p className="text-sm font-medium leading-none">{member.name}</p>
                                            <p className="text-sm text-muted-foreground">{member.email}</p>
                                        </div>
                                    </div>
                                    <ConfirmButton onConfirm={() => alert("clicked")}
                                                   dialogDescription={`You want to delete ${member.name}`}>
                                        <Button variant="outline" size="icon">
                                            <TrashIcon className="h-4 w-4"/>
                                        </Button>
                                    </ConfirmButton>
                                </div>
                            ))}
                        </CardContent>
                        <CardFooter className="flex justify-stretch">
                            <Button variant="ghost" className="w-full">
                                <PlusIcon className='mr-1 w-4 h-4'/> Invite
                            </Button>
                        </CardFooter>
                    </Card>
                </div>
                <div className="space-y-4">
                    <Card>
                        <CardHeader>
                            <CardTitle>Files</CardTitle>
                            <CardDescription>Upload your SRS/SDS Documents here</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-2">
                                {files.map((member) => (
                                    <ListTile key={member.id}>
                                        <ListTileContent>
                                            <ListTileTitle>{member.name}</ListTileTitle>
                                            <ListTileDescription>
                                                <Button variant="link" className="">preview</Button>
                                            </ListTileDescription>
                                        </ListTileContent>
                                        <ListTileTrailing>
                                            <Button variant="outline" size="icon">
                                                <DownloadIcon className="h-4 w-4"/>
                                            </Button>
                                            <ConfirmButton onConfirm={() => alert("clicked")}
                                                           dialogDescription={`You want to delete ${member.name}`}>
                                                <Button variant="outline" className="text-red-600" size="icon">
                                                    <TrashIcon className="h-4 w-4"/>
                                                </Button>
                                            </ConfirmButton>
                                        </ListTileTrailing>
                                    </ListTile>
                                ))}
                            </div>
                        </CardContent>
                        <CardFooter>
                            <Button variant="ghost" className="w-full">
                                <UploadIcon className='mr-1 w-4 h-4'/> Upload
                            </Button>
                        </CardFooter>
                    </Card>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
