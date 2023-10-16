import * as React from "react"
import {cva, type VariantProps} from "class-variance-authority"

import {cn} from "@/lib/utils"

const listTileVariants = cva(
    "relative w-full rounded-lg border p-4 flex flex-row",
    {
        variants: {
            variant: {
                default: "bg-background text-foreground",
                destructive:
                    "border-destructive/50 text-destructive dark:border-destructive [&>svg]:text-destructive",
            },
        },
        defaultVariants: {
            variant: "default",
        },
    }
)

const ListTile = React.forwardRef<
    HTMLDivElement,
    React.HTMLAttributes<HTMLDivElement> & VariantProps<typeof listTileVariants>
>(({className, variant, ...props}, ref) => (
    <div
        ref={ref}
        role="listTile"
        className={cn(listTileVariants({variant}), className)}
        {...props}
    />
))
ListTile.displayName = "ListTile"
const ListTileLeading = React.forwardRef<
    HTMLParagraphElement,
    React.HTMLAttributes<HTMLParagraphElement>
>(({className, ...props}, ref) => (
    <div
        ref={ref}
        className={cn("mr-3 [&>svg]:text-foreground flex items-center", className)}
        {...props}
    />
))

ListTileLeading.displayName = "ListTileLeading"

const ListTileContent = React.forwardRef<
    HTMLParagraphElement,
    React.HTMLAttributes<HTMLHeadingElement>
>(({className, ...props}, ref) => (
    <div
        ref={ref}
        className={cn("flex-grow flex flex-col items-start justify-center", className)}
        {...props}
    />
))
ListTileContent.displayName = "ListTileContent"

const ListTileTitle = React.forwardRef<
    HTMLParagraphElement,
    React.HTMLAttributes<HTMLHeadingElement>
>(({className, ...props}, ref) => (
    <h5
        ref={ref}
        className={cn("mb-1 font-medium leading-none tracking-tight", className)}
        {...props}
    />
))
ListTileTitle.displayName = "ListTileTitle"

const ListTileDescription = React.forwardRef<
    HTMLParagraphElement,
    React.HTMLAttributes<HTMLParagraphElement>
>(({className, ...props}, ref) => (
    <div
        ref={ref}
        className={cn("text-sm [&_p]:leading-relaxed", className)}
        {...props}
    />
))
ListTileDescription.displayName = "ListTileDescription"

const ListTileTrailing = React.forwardRef<
    HTMLParagraphElement,
    React.HTMLAttributes<HTMLParagraphElement>
>(({className, ...props}, ref) => (
    <div
        ref={ref}
        className={cn("ml-3 flex items-center space-x-2", className)}
        {...props}
    />
))
ListTileTrailing.displayName = "ListTileTrailing"

export {ListTile, ListTileLeading, ListTileTitle, ListTileDescription, ListTileTrailing, ListTileContent}
